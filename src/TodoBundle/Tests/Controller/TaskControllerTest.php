<?php

namespace TodoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    /** @var \Symfony\Bundle\FrameworkBundle\Client client */
    protected $client;

    public function logInAs($username)
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->filter('button[type=submit]')->form();
        $data = array(
            '_username' => 'admin',
            '_password' => 'test',
        );

        $this->client->submit($form, $data);
    }

    private function getClient()
    {
        $this->client = static::createClient();
    }

    public function testNewTaskForm()
    {
        $this->getClient();

        $this->client->request('GET', '/task/create');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('task.form.save', $this->client->getResponse()->getContent());
    }

    public function testNewTaskSuccess()
    {
        $this->getClient();

        $crawler = $this->client->request('GET', '/task/create');
        $form = $crawler->filter('button[type=submit]')->form();

        $data = array(
            'task[label]' => 'task 1',
            'task[description]' => 'go to the supermarket',
            'task[status]' => 1,
        );

        $this->client->submit($form, $data);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Task added with success', $this->client->getResponse()->getContent());
    }

    public function testNewTaskFail()
    {
        $this->getClient();

        $crawler = $this->client->request('GET', '/task/create');
        $form = $crawler->filter('button[type=submit]')->form();

        $data = array(
            'task[label]' => 'task 1',
            'task[description]' => 'go to the supermarket',
            'task[status]' => "TEST",
        );

        $this->client->submit($form, $data);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertContains('This value is not valid', $this->client->getResponse()->getContent());
    }

    public function testNewTaskServerError()
    {
        $this->getClient();

        $crawler = $this->client->request('GET', '/task/create');
        $form = $crawler->filter('button[type=submit]')->form();

        $this->client->submit($form);
        $this->assertEquals(500, $this->client->getResponse()->getStatusCode());
    }
}