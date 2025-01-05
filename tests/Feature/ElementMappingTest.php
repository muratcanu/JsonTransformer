<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ElementMapping;

class ElementMappingTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_elements()
    {
        $response = $this->get(route('ElementMappingController.showAll'));

        $response->assertStatus(200);
        $response->assertViewIs('elementMappingList');
        $response->assertViewHas('mappingData');
    }

    public function test_add_element_form()
    {
        $response = $this->get(route('ElementMappingController.showAdd'));

        $response->assertStatus(200);
        $response->assertViewIs('elementMappingForm');
    }

    public function test_submit_element()
    {
        $submitData = [
            'elementorType' => 'section',
            'frontendType' => 'container',
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
        $finalData = [
            'elementor_type' => 'section',
            'frontend_type' => 'container',
            'settings_mapper' => '[
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

        $response = $this->post(route('ElementMappingController.add'), $submitData);

        $response->assertStatus(302);
        $response->assertRedirect(route('ElementMappingController.showAll'));
        $this->assertDatabaseHas('element_mappings', $finalData);
    }

    public function test_edit_element_form()
    {
        $element = ElementMapping::create([
            'elementor_type' => 'INITIAL TEST ELEMENTOR VALUE',
            'frontend_type' => 'INITIAL TEST FRONTEND VALUE',
            'settings_mapper' => 'INITIAL SETTINGS MAPPER VALUE'
        ]);

        $response = $this->get(route('ElementMappingController.showEdit', ['id' => $element->id]));

        $response->assertStatus(200);
        $response->assertViewIs('elementMappingEditForm');
        $response->assertViewHas('mappingData');
    }

    public function test_edit_element()
    {
        $element = ElementMapping::create([
            'elementor_type' => 'INITIAL TEST ELEMENTOR VALUE',
            'frontend_type' => 'INITIAL TEST FRONTEND VALUE',
            'settings_mapper' => 'INITIAL SETTINGS MAPPER VALUE'
        ]);
        $initData = [
            'elementorType' => 'UPDATED TEST ELEMENTOR VALUE',
            'frontendType' => 'UPDATED TEST FRONTEND VALUE',
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
        $finalData = [
            'elementor_type' => 'UPDATED TEST ELEMENTOR VALUE',
            'frontend_type' => 'UPDATED TEST FRONTEND VALUE',
            'settings_mapper' => '[
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

        $response = $this->put(route('ElementMappingController.edit', ['id' => $element->id]), $initData);
        
        $response->assertStatus(302);
        $response->assertRedirect(route('ElementMappingController.showAll'));
        $this->assertDatabaseHas('element_mappings', $finalData);
    }
}
