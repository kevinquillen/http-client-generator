<?php

declare(strict_types=1);

namespace Drupal\http_client_generator\Generators;

use DrupalCodeGenerator\Command\ModuleGenerator;

/**
 * Implements HttpClient generator command.
 */
final class HttpClient extends ModuleGenerator {

  /**
   * The Drush generator command name.
   *
   * @var string
   */
  protected string $name = 'http-client';

  /**
   * The Drush generator command description.
   *
   * @var string
   */
  protected string $description = 'Generates an HTTP client for interacting with remote APIs.';

  /**
   * The path to the templates for the generator.
   *
   * @var string
   */
  protected string $templatePath = __DIR__ . '/../../templates';

  /**
   * {@inheritdoc}
   */
  protected function generate(array &$vars): void {
    $this->collectDefault($vars);
    $vars['class'] = $this->ask('Class', '{machine_name|camelize}HttpClient');
    $vars['package'] = '{machine_name|camelize}';
    $vars['menu_path'] = '{machine_name|u2h}';
    $vars['description'] = $this->ask('Module description', 'Generates an HTTP client for interacting with remote APIs.', '::validateRequired');

    $this->addFile('{machine_name}.info.yml', 'module/model.info.yml')->skipIfExists();
    $this->addFile('config/schema/{machine_name}.schema.yml', 'config/schema/model.schema.yml')->appendIfExists();
    $this->addFile('src/HttpClient/{class}.php', 'http/http-client');
    $this->addFile('src/Form/{class}SettingsForm.php', 'form/settings');
    $this->addFile('{machine_name}.links.menu.yml', 'menu/links/model.links.menu.yml')->appendIfExists();
    $this->addFile('{machine_name}.links.task.yml', 'menu/task/model.links.task.yml')->appendIfExists();
    $this->addFile('{machine_name}.routing.yml', 'routing/model.routing.yml')->appendIfExists();
    $this->addFile('{machine_name}.services.yml', 'services/model.services.yml')->appendIfExists();
  }

}
