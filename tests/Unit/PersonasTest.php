<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\personas;

class PersonasTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function Alta_Persona_Test()
    {
        $persona = new personas();
        $persona->nombre = 'Juan';
        $persona->apellido = 'Pérez';
        $persona->telefono = '1234567890';

        $this->assertTrue($persona->save());
    }

    public function Modificar_Persona_Test()
    {
        $persona = personas::find(1);
        $persona->nombre = 'Juanito';
        $persona->apellido = 'Pérez';

        $this->assertTrue($persona->save());
    }

    public function Eliminar_Persona_Test()
    {
        $persona = personas::find(1);
        $this->assertTrue($persona->delete());
    }

    public function Listar_Personas_Test()
    {
        $personas = personas::all();
        $this->assertNotEmpty($personas);
    }

    public function Buscar_Persona_Test()
    {
        $persona = personas::find(1);
        $this->assertEquals('Juan', $persona->nombre);
    }

    public function Error_Alta_Persona()
    {
        $persona = new personas();
        $persona->nombre = '';
        $persona->apellido = 'Pérez';
        $persona->telefono = '1234567890';

        $this->assertFalse($persona->save());
    }

    public function Error_Modificar_Persona()
    {
        $persona = personas::find(1);
        $persona->nombre = '';

        $this->assertFalse($persona->save());
    }

    public function Error_Buscar_Persona()
    {
        $persona = personas::find(0);
        $this->assertNull($persona);
    }

    public function Error_Eliminar_Persona()
    {
        $persona = personas::find(0);
        $this->assertFalse($persona->delete());
    }

    public function Error_Listar_Personas()
    {
        $personas = personas::all();
        $this->assertEmpty($personas);
    }
}
