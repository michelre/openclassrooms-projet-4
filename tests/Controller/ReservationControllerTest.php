<?php


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationControllerTest extends WebTestCase
{
    public function testIsReservationAvailable()
    {
        $client = static::createClient();

        $client->request('GET', '/api/reservation/available?date=21/08/2018&nbPlaces=2');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"isDateAvailable":true}', $client->getResponse()->getContent());

        $client->request('GET', '/api/reservation/available?date=21/08/2018&nbPlaces=1001');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"isDateAvailable":false}', $client->getResponse()->getContent());
    }

    public function testValidateForm()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/reservation',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"nbPlaces":1,"visitDate":"22/08/2018","visitors":[{"fullName":"Anne G.","country":"fr","birthdate":"12/08/1988","isHalf":false,"tarif":{"id":1,"name":"normal","price":16}}],"isDateAvailable":true,"isHalf":false,"email":"foo@bar.com"}'
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

}
