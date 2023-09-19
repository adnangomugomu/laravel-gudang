<?php

namespace App\Models;

use Database\Factories\ProdukFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
	use SoftDeletes, HasUuids, HasFactory;

	protected $table = 'produk';

	protected $factory = ProdukFactory::class;

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
}
