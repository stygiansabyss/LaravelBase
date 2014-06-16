<?php

class SessionCest
{
    public function logIn(AcceptanceTester $I)
    {
        $I->wantTo('log in');

        $I->amOnPage('/');
        $I->click('Login');
        $I->fillField('username', 'stygian');
        $I->fillField('password', 'test');
        $I->click('Login');
        $I->see('Stygian');
    }

    public function logOut(AcceptanceTester $I)
    {
        $I->wantTo('log out');

        $I->amOnPage('/');
        $I->click('Login');
        $I->fillField('username', 'stygian');
        $I->fillField('password', 'test');
        $I->click('Login');
        $I->amOnPage('/logout');
        $I->see('Login');
    }
}