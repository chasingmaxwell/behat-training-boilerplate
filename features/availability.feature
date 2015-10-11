Feature: The site should be available.
  In order to use the site
  As a user
  I need to have access to the site

  Scenario: A user views the homepage
    Given I am an anonymous user
    When I go to the homepage
    Then I should be on the homepage
