/* Regular Expression escape function */
RegExp.escape= function(s) {
    return s.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&')
};

function uuuMenuSetBreadcrumbs(topLevel,botLevel)
{
  if(typeof topLevel != "string")
    console.error("First argument invalid");
  if(typeof botLevel != "string" && botLevel != null)
    console.error("Second argument invalid");

  var foundTop=false,foundBot=false;

  $("#top_level_nav").children('li').each(function(index)
  {
    var text=$(this).text();

    //Try to do regex match. We assume we don't need to escape text
    if( text.match(new RegExp("^\s*" + RegExp.escape(topLevel))) != null)
    {
      //found top level match
      uuuMenuTopLevelSelect.call(this,false);
      foundTop=true;

      return false; //Stop loop
    }
  });

  if(!foundTop) console.error("Could not find top level menu element:" + topLevel);
  if(!foundBot && botLevel != null) console.error("Could not find menu element: " + topLevel + " > " + botLevel);
}

/*
this needs to be set to the li element clicked on
*/
function uuuMenuTopLevelSelect(followURL)
{
  var clicked=$(this);

  $(this).parent().children('li').each(function(index)
  {
    if($(this).get(0) == clicked.get(0))
    {
      //Show bottom level menu options
      $(this).children('div.bottom_level_nav').fadeIn();
      $(this).addClass("top_level_selected");

      //Remove hover behaviour, because it's selected
      $(this).unbind('mouseenter mouseleave');
      $(this).removeClass('top_level_hover');

      //The Bottom level menu we just showed needs hover behaviour
      $(this).children('div.bottom_level_nav').children('ul').children('li').each(function(index)
      {
        uuuMenuBotLevelAddHover.call(this);
      }
      );

      if(followURL && $(this).children('a').length != 0)
      {
        //There is no sub menu so follow link
        window.location = $(this).children('a').attr('href');
      }

    }
    else
    {
      //Hide bottom level menu options
      $(this).children('div.bottom_level_nav').hide();
      $(this).removeClass("top_level_selected");

      //add hover behaviour, because it's not selected
      $(this).hover(function()
      {
        $(this).addClass('top_level_hover');
      },
      function()
      {
        $(this).removeClass('top_level_hover');
      }
      );
    }
  }
  );
}


$(document).ready(function() 
{
  $('#top_level_nav > li').click(function()
  {
    //Set this and request that we follow URLs
    uuuMenuTopLevelSelect.call(this,true);
  });

  /* Javascript is working so remove the special CSS
     class that makes the menu "sort of work" in browsers
     with Javascript disabled */
  $("html").removeClass("no-js");

  /* Show correct pointer for the javascript menu */
  $("#top_level_nav li").addClass('clickable_button');

  /* IE6/7 doesn't respect CSS property
  * outline: none; This hack hides the outline on links
  * in the menu
  */
  if($("html").hasClass("lte-ie7"))
  {
    $("#top_level_nav a").attr("hideFocus","true");
  }

});
