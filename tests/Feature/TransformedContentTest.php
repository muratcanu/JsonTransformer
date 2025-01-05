<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class TransformedContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_transformed_contents()
    {
        $response = $this->get(route('TransformedElementController.showAll'));

        $response->assertStatus(200);
        $response->assertViewIs('transformedElementList');
        $response->assertViewHas('contentData');
    }

    public function test_submit_content_form()
    {
        $response = $this->get(route('TransformedElementController.showAdd'));

        $response->assertStatus(200);
        $response->assertViewIs('transformedElementForm');
    }

    public function test_transform_content()
    {
        $elemDataColumn = [
            'elementorType' => 'column',
            'frontendType' => 'column',
            'settingsMapper' => '[
                "id" => $data["id"],
                "type" => "column",
                "settings" => [
                    "width" => $data["settings"]["_column_size"] . $data["settings"]["_margin_mobile"]["unit"],
                    "margin" => [
                        "mobile" => [
                            "top" => $data["settings"]["_margin_mobile"]["top"] . $data["settings"]["_margin_mobile"]["unit"],
                            "right" => $data["settings"]["_margin_mobile"]["right"] . $data["settings"]["_margin_mobile"]["unit"],
                            "bottom" => $data["settings"]["_margin_mobile"]["bottom"] . $data["settings"]["_margin_mobile"]["unit"],
                            "left" => $data["settings"]["_margin_mobile"]["left"] . $data["settings"]["_margin_mobile"]["unit"]
                        ]
                    ]
                ]
            ]'
        ];
        $elemDataWidget = [
            'elementorType' => 'widget',
            'frontendType' => 'heading',
            'settingsMapper' => '[
                "id" => $data["id"], // Map "id" directly
                "type" => $data["widgetType"], // Map "widgetType" to "type"
                "settings" => [
                    "textAlign" => $data["settings"]["align"] // Map "align" to "settings.textAlign"
                ],
                "content" => $data["settings"]["title"], // Map "title" to "content"
                "dynamic" => [
                    "content" => [
                        "source" => "post", // Static value
                        "field" => "title"  // Static value
                    ]
                ]
            ]'
        ];
        $elemDataSection = [
            'elementorType' => 'section',
            'frontendType' => 'container',
            'settingsMapper' => '[
                "id" => $data["id"],
                "type" => "container",
                "settings" => [
                    "width" => $data["settings"]["layout"] === "full_width" ? "full" : "boxed",
                    "padding" => [
                        "desktop" => [
                            "top" => $data["settings"]["padding"]["top"] . $data["settings"]["padding"]["unit"],
                            "right" => $data["settings"]["padding"]["right"] . $data["settings"]["padding"]["unit"],
                            "bottom" => $data["settings"]["padding"]["bottom"] . $data["settings"]["padding"]["unit"],
                            "left" => $data["settings"]["padding"]["left"] . $data["settings"]["padding"]["unit"]
                        ],
                        "tablet" => [
                            "top" => $data["settings"]["padding_tablet"]["top"] . $data["settings"]["padding_tablet"]["unit"],
                            "right" => $data["settings"]["padding_tablet"]["right"] . $data["settings"]["padding_tablet"]["unit"],
                            "bottom" => $data["settings"]["padding_tablet"]["bottom"] . $data["settings"]["padding_tablet"]["unit"],
                            "left" => $data["settings"]["padding_tablet"]["left"] . $data["settings"]["padding_tablet"]["unit"]
                        ],
                        "mobile" => [
                            "top" => $data["settings"]["padding_mobile"]["top"] . $data["settings"]["padding_mobile"]["unit"],
                            "right" => $data["settings"]["padding_mobile"]["right"] . $data["settings"]["padding_mobile"]["unit"],
                            "bottom" => $data["settings"]["padding_mobile"]["bottom"] . $data["settings"]["padding_mobile"]["unit"],
                            "left" => $data["settings"]["padding_mobile"]["left"] . $data["settings"]["padding_mobile"]["unit"]
                        ]
                    ],
                    "animation" => [
                        "type" => $data["settings"]["animation"],
                        "duration" => $data["settings"]["animation_duration"] === "slow" ? 1000 : 500,
                        "delay" => $data["settings"]["animation_delay"]
                    ],
                    "customCSS" => [
                        "styles" => $data["settings"]["custom_css"],
                        "classes" => explode(" ", $data["settings"]["custom_css_classes"])
                    ]
                ]
            ]'
        ];

        $this->post(route('ElementMappingController.add'), $elemDataColumn);
        $this->post(route('ElementMappingController.add'), $elemDataWidget);
        $this->post(route('ElementMappingController.add'), $elemDataSection);

        $initalData = [
            'sourceId' => 'TEST SOURCE ID',
            'rawContent' => '{
                "id": "section1",
                "elType": "section",
                "settings": {
                    "layout": "full_width",
                    "padding": {
                        "unit": "px",
                        "top": "20",
                        "right": "0",
                        "bottom": "20",
                        "left": "0"
                    },
                    "padding_tablet": {
                        "unit": "px",
                        "top": "10",
                        "right": "0",
                        "bottom": "10",
                        "left": "0"
                    },
                    "padding_mobile": {
                        "unit": "px",
                        "top": "5",
                        "right": "0",
                        "bottom": "5",
                        "left": "0"
                    },
                    "animation": "fadeIn",
                    "animation_duration": "slow",
                    "animation_delay": 200,
                    "custom_css": ".elementor-widget-heading { text-shadow: 2px 2px #ff0000; }",
                    "custom_css_classes": "my-custom-class another-class",
                    "dynamic": {
                        "title": {
                            "type": "post",
                            "field": "title"
                        }
                    }
                },
                "elements": [
                    {
                        "id": "column1",
                        "elType": "column",
                        "settings": {
                            "_column_size": 50,
                            "_margin_mobile": {
                                "unit": "%",
                                "top": "0",
                                "right": "10",
                                "bottom": "0",
                                "left": "10"
                            }
                        },
                        "elements": [
                            {
                                "id": "widget1",
                                "elType": "widget",
                                "widgetType": "heading",
                                "settings": {
                                    "title": "Hello World",
                                    "align": "center"
                                }
                            }
                        ]
                    }
                ]
            }',
        ];
        $finalData = [
            'source_id' => 'TEST SOURCE ID',
            'transformed_content' => json_encode('{"id":"section1","type":"container","settings":{"width":"full","padding":{"desktop":{"top":"20px","right":"0px","bottom":"20px","left":"0px"},"tablet":{"top":"10px","right":"0px","bottom":"10px","left":"0px"},"mobile":{"top":"5px","right":"0px","bottom":"5px","left":"0px"}},"animation":{"type":"fadeIn","duration":1000,"delay":200},"customCSS":{"styles":".elementor-widget-heading { text-shadow: 2px 2px #ff0000; }","classes":["my-custom-class","another-class"]}},"children":{"id":"column1","type":"column","settings":{"width":"50%","margin":{"mobile":{"top":"0%","right":"10%","bottom":"0%","left":"10%"}}},"children":{"id":"widget1","type":"heading","settings":{"textAlign":"center"},"content":"Hello World","dynamic":{"content":{"source":"post","field":"title"}}}}}'),
        ];

        $response = $this->post(route('TransformedElementController.add'), $initalData);

        $response->assertStatus(302);
        $response->assertRedirect(route('TransformedElementController.showAll'));
        $this->assertDatabaseHas('transformed_contents', $finalData);
    }
}
