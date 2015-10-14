<?php

use Drupal\DrupalExtension\Context\RawDrupalContext;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawDrupalContext implements SnippetAcceptingContext {

  /** @var array Variables which have been changed and should be reset. */
  private $changedVariables = array();

  /**
   * Initializes context.
   *
   * Every scenario gets its own context instance.
   * You can also pass arbitrary arguments to the
   * context constructor through behat.yml.
   */
  public function __construct() {
  }

  /**
   * @Given the site is in maintenance mode
   */
  public function theSiteIsInMaintenance() {
    $var = variable_get('maintenance_mode');
    if (!$var) {
      variable_set('maintenance_mode', TRUE);
      $this->trackChangedVariable('maintenance_mode', $var);
    }
  }

  /**
   * @Given the site is not in maintenance mode
   */
  public function theSiteIsNotInMaintenance() {
    $var = variable_get('maintenance_mode');
    if ($var) {
      variable_set('maintenance_mode', FALSE);
      $this->trackChangedVariable('maintenance_mode', $var);
    }
  }

  /**
   * Track the original state of a changed variable.
   */
  protected function trackChangedVariable($name, $value) {
    if (!key_exists($name, $this->changedVariables)) {
      $this->changedVariables[$name] = $value;
    }
  }

  /**
   * Set changed variables to their original state.
   *
   * @AfterScenario
   */
  public function resetVariables() {
    foreach ($this->changedVariables as $var => $value) {
      if (isset($value)) {
        // If the original value was something other than NULL, set it back.
        variable_set($var, $value);
      }
      else {
        // Unset the variable if it didn't exist before.
        variable_del($var);
      }
    }
  }

}
