<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
	protected $table = 'collections';
	protected $fillable = ['name', 'collection_type'];

	public function fields()
	{
		return $this->hasMany('App\Models\CollectionField');
	}
}