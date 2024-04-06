<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionField extends Model
{
	protected $table = 'collections_fields';
	protected $fillable = ['name', 'value', 'collection_id', 'field_id'];

	public function collection()
	{
		return $this->belongsTo('App\Models\Collection');
	}
	
}