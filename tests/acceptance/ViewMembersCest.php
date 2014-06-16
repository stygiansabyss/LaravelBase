<?php

class ViewMembersCest
{

    // tests
    public function viewMemberlist(AcceptanceTester $I)
    {
        $I->wantTo('view all members');

        $I->amOnPage('/');
        $I->click('Memberlist');
        $I->see('Riddles');
        $I->see('Stygian');
    }
}