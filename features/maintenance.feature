@api
Feature: Maintenance mode
  In order to safely update the site
  As an administrator
  I need the site to be unavailable in maintenance mode

  Scenario: An anonymous user cannot access site content in maintenance mode
    Given I am an anonymous user
    And the site is not in maintenance mode
    And I am viewing an Article with the title "Test normal mode"
    Then I should see the heading "Test normal mode"
    Given the site is in maintenance mode
    And I am viewing an Article with the title "Test maintenance mode"
    Then I should not see the heading "Test maintenance mode"
