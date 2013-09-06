<?php

class Game_Item extends BaseModel
{
	/********************************************************************
	 * Declarations
	 *******************************************************************/
	public static $table = 'game_items';

	/********************************************************************
	 * Aware validation rules
	 *******************************************************************/
	public static $rules = array(
		'game_type_id'        => 'required|exists:games,uniqueId',
		'game_item_rarity_id' => 'required|exists:game_item_rarities,id',
		'name'                => 'required|max:200',
	);

	/********************************************************************
	 * Relationships
	 *******************************************************************/
	public function gameType()
	{
		return $this->belongsTo('Game_Type', 'game_type_id');
	}
	public function rarity()
	{
		return $this->belongsTo('Game_Item_Rarity', 'game_item_rarity_id');
	}
	public function quests()
	{
		return $this->hasMany('Game_Quest_Item', 'game_item_id');
	}
	public function characters()
	{
		return $this->hasMany('Game_Item_Npc', 'game_item_id');
	}

	/********************************************************************
	 * Model events
	 *******************************************************************/

	public static function boot()
	{
		parent::boot();

		Game_Item::creating(function($object)
		{
			$object->uniqueId = parent::findExistingReferences('Game_Item');
		});
	}

	/********************************************************************
	 * Getter and Setter methods
	 *******************************************************************/

	/********************************************************************
	 * Extra Methods
	 *******************************************************************/
}