@api
Feature: Content can be created and edited.
  In order to inform users
  As an administrator
  I need to add and edit content on the site

  Scenario: An administrator can edit an article
    Given I am logged in as a user with the administrator role
    Then I should be able to edit an Article

  Scenario: An authenticated user can not edit an article
    Given I am logged in as a user with the authenticated role
    When I go to "/node/add/article"
    Then the response status code should be 403

  Scenario: An administrator can edit a page
    Given I am logged in as a user with the administrator role
    Then I should be able to edit a "Basic page"

  Scenario: An authenticated user can not edit a page
    Given I am logged in as a user with the authenticated role
    When I go to "/node/add/page"
    Then the response status code should be 403
