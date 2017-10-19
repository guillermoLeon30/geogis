<?php

namespace App\Validacion;
use Illuminate\Validation\Validator;

class Validacion extends Validator
{
	public function validateIdsArregloDistintos($attribute, $value, $parameters){
		$ids = array_pluck($value, 'id');
		$ids = array_count_values($ids);
		
		foreach ($ids as $id => $cant) {
			if ($cant > 1) {
				return false;
			}
		}

		return true;
	}
}