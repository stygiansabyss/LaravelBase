<?php

class Forum_Moderation_Log extends BaseModel
{
	/********************************************************************
	 * Declarations
	 *******************************************************************/

	/**
	 * Table declaration
	 *
	 * @var string $table The table this model uses
	 */
	protected $table = 'forum_moderation_logs';

	/********************************************************************
	 * Aware validation rules
	 *******************************************************************/

    /**
     * Validation rules
     *
     * @static
     * @var array $rules All rules this model must follow
     */
	public static $rules = array(
		'forum_moderation_id' => 'required|exists:forum_moderation,id',
		'user_id'             => 'required|exists:users,uniqueId',
		'action'              => 'required',
	);

	/********************************************************************
	 * Scopes
	 *******************************************************************/

	/********************************************************************
	 * Relationships
	 *******************************************************************/

    /**
     * Forum Moderation Relationship
     *
     * @return Forum_Moderation
     */
	public function moderation()
	{
		return $this->belongsTo('Forum_Moderation', 'forum_moderation_id')->withTrashed();
	}

    /**
     * User Relationship
     *
     * @return User
     */
	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/********************************************************************
	 * Getter and Setter methods
	 *******************************************************************/

	/********************************************************************
	 * Extra Methods
	 *******************************************************************/

}