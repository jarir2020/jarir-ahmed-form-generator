<?php

namespace JarirAhmed\FormGenerator\Tests;

use JarirAhmed\FormGenerator\ContactUsForm;
use JarirAhmed\FormGenerator\LoginForm;
use JarirAhmed\FormGenerator\RegistrationForm;
use PHPUnit\Framework\TestCase;

class FormGeneratorTest extends TestCase
{
    public function testDefaultRenderIsBackwardCompatible()
    {
        $html = LoginForm::render();
        $this->assertStringContainsString('<form', $html);
        $this->assertStringContainsString('action="/login"', $html);
        $this->assertStringContainsString('name="password"', $html);
    }

    public function testDefaultActionsPerForm()
    {
        $this->assertStringContainsString('action="/login"', LoginForm::render());
        $this->assertStringContainsString('action="/register"', RegistrationForm::render());
        $this->assertStringContainsString('action="/contact"', ContactUsForm::render());
    }

    public function testCustomActionIsUsed()
    {
        $html = LoginForm::render(['action' => '/auth/sign-in']);
        $this->assertStringContainsString('action="/auth/sign-in"', $html);
    }

    public function testMaliciousActionIsEscaped()
    {
        $html = LoginForm::render(['action' => '"><script>alert(1)</script>']);
        $this->assertStringNotContainsString('<script>alert(1)', $html);
        $this->assertStringContainsString('&lt;script&gt;', $html);
    }

    public function testCsrfFieldEmittedWhenTokenGiven()
    {
        $html = LoginForm::render(['csrfToken' => 'abc123']);
        $this->assertStringContainsString('<input type="hidden" name="_token" value="abc123">', $html);
    }

    public function testCsrfFieldAbsentByDefault()
    {
        $this->assertStringNotContainsString('_token', LoginForm::render());
    }

    public function testCsrfTokenValueIsEscaped()
    {
        $html = LoginForm::render(['csrfToken' => '"><script>x</script>']);
        $this->assertStringNotContainsString('<script>x', $html);
    }

    public function testCustomCsrfFieldName()
    {
        $html = RegistrationForm::render(['csrfToken' => 't', 'csrfFieldName' => 'csrf_token']);
        $this->assertStringContainsString('name="csrf_token"', $html);
    }

    public function testPrefilledValuesAreEscaped()
    {
        $html = RegistrationForm::render(['values' => ['email' => '"><script>evil</script>']]);
        $this->assertStringNotContainsString('<script>evil', $html);
        $this->assertStringContainsString('&lt;script&gt;', $html);
    }

    public function testPrefilledValueRoundTripsSafeInput()
    {
        $html = ContactUsForm::render(['values' => ['name' => 'Jane Doe']]);
        $this->assertStringContainsString('value="Jane Doe"', $html);
    }

    public function testStylesCanBeDisabled()
    {
        $this->assertStringNotContainsString('<style>', LoginForm::render(['styles' => false]));
        $this->assertStringContainsString('<style>', LoginForm::render());
    }

    public function testInvalidMethodFallsBackToPost()
    {
        $html = LoginForm::render(['method' => 'DELETE']);
        $this->assertStringContainsString('method="POST"', $html);
    }

    public function testGetMethodRespected()
    {
        $html = ContactUsForm::render(['method' => 'get']);
        $this->assertStringContainsString('method="GET"', $html);
    }

    public function testPasswordNeverPrefilled()
    {
        $html = LoginForm::render(['values' => ['password' => 'secret']]);
        $this->assertStringNotContainsString('secret', $html);
    }
}
