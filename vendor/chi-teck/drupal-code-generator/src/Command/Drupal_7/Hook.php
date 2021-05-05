<?php

namespace DrupalCodeGenerator\Command\Drupal_7;

use DrupalCodeGenerator\Command\BaseGenerator;
use DrupalCodeGenerator\Utils;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * Implements d7:hook command.
 */
class Hook extends BaseGenerator {

  protected $name = 'd7:hook';
  protected $description = 'Generates a hook';

  /**
   * {@inheritdoc}
   */
  protected function interact(InputInterface $input, OutputInterface $output) {
    $questions = Utils::defaultQuestions();
    $questions['hook_name'] = new Question('Hook name');
    $questions['hook_name']->setValidator(function ($value) {
      if (!in_array($value, $this->getSupportedHooks())) {
        throw new \UnexpectedValueException('The value is not correct hook name.');
      }
      return $value;
    });
    $questions['hook_name']->setAutocompleterValues($this->getSupportedHooks());

    $vars = $this->collectVars($input, $output, $questions);

    // Most Drupal hooks are situated in a module file but some are not.
    $special_hooks = [
      'install' => [
        'install',
        'uninstall',
        'enable',
        'disable',
        'schema',
        'schema_alter',
        'field_schema',
        'requirements',
        'update_N',
        'update_last_removed',
      ],
      // See system_hook_info().
      'tokens.inc' => [
        'token_info',
        'token_info_alter',
        'tokens',
        'tokens_alter',
      ],
    ];

    $file_type = 'module';
    foreach ($special_hooks as $group => $hooks) {
      if (in_array($vars['hook_name'], $hooks)) {
        $file_type = $group;
        break;
      }
    }

    $this->addFile()
      ->path("{machine_name}.$file_type")
      ->headerTemplate("d7/file-docs/$file_type.twig")
      ->template('d7/hook/' . $vars['hook_name'] . '.twig')
      ->action('append')
      ->headerSize(7);
  }

  /**
   * Gets list of supported hooks.
   *
   * @return array
   *   List of supported hooks.
   */
  protected function getSupportedHooks() {
    return array_map(function ($file) {
      return pathinfo($file, PATHINFO_FILENAME);
    }, array_diff(scandir($this->templatePath . '/d7/hook'), ['.', '..']));
  }

}
