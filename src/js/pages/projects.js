$(function() {
  /**
   * Form filter script - start
   */
  $('#button-filter-projects').on('click', function() {
    const projectsFilterArea = $('#projects-filter-area');
    const projectsFilterAreaClass = 'ProjectsContent__filter--active';
    const buttonClass = 'Button--active-filter';

    if (!projectsFilterArea.hasClass(projectsFilterAreaClass)) {
      projectsFilterArea.addClass(projectsFilterAreaClass);
      $(this).addClass(buttonClass);
    } else {
      projectsFilterArea.removeClass(projectsFilterAreaClass);
      $(this).removeClass(buttonClass);
    }
  });

  // Leave form
  $('#projects-filter-area').on('mouseleave', function() {
    $(this).removeClass('ProjectsContent__filter--active');
    $('#button-filter-projects').removeClass('Button--active-filter');
  })
  /**
   * Form filter script - end
   */
})