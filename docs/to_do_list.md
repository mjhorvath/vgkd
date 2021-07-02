This list may be out of date.

### Highest Priority
* "Browserstack.com" allows FOSS projects free access to their services. I need 
  to create an account there and periodically check the site for problems.
* Double-check to make sure whether stored procedures have been (re-)enabled on 
  my (hosted) Web server following the hosting company's winter holiday update.
* There are still missing "group" IDs for many SHIFT, CTRL, ALT, etc. bindings. 
  [Ed. this will be a time-consuming thing to retroactively fix. The submission 
  form does complain about this in some instances, however.]
* The submission form needs to remember which bindings were gotten straight 
  from the database (and therefore should retain their original primary key 
  IDs) and which bindings were newly added by users (and therefore require NULL 
  primary key IDs). This applies to regular key bindings as well as combos/mice.
  [Ed. I don't recall why this was important. Currently, when updating an 
  existing set of bindings, I delete them and then re-add them as if they were 
  all new.]

### Submission Form
* Continue developing the "TSV Pane" of the submission form, and permit 
  users to alter or update the keyboard bindings directly using it.
  [Ed. this pane has been renamed "SQL pane", and now displays SQL code. I want 
  to re-add the TSV stuff so that the user has the option to view both types of 
  code, however.]
* There needs to be more indication on the submission page that there is a 
  "Help Pane" as well as a "TSV Pane".
* Users should maybe be able to enter text directly onto the keyboard diagram 
  on the submission form. Have to think this through, as things could get very 
  messy.
  [Ed. I could make the vertical input table pop up to the side of each key, 
  thereby eliminating the need for the sidebar.]
* Need to create a form for users to create and submit new keyboard layouts 
  with. Or, support layout scripts generated using other software such as 
  [Keyboard Layout Editor](http://www.keyboard-layout-editor.com/). Or, I could 
  write a desktop application for this. Or, I could create a spreadsheet for 
  this.
* Need to switch to using something other than JavaScript alert boxes for 
  providing users with feedback. Alert boxes can be disabled by users in some 
  browsers, which may break the form. Custom HTML alert boxes could also be 
  made to look prettier than typical JavaScript alert boxes.
* On the submission form, replace the "X" icon in the toolbar with plus and 
  minus icons.
* Should maybe make the size of the left pane adjustable.
* Link to the Excel sheet directly from the submission form, so that those who 
  might prefer using it over the default methods will have easier access to it. 
  [Ed. should I put the link in the help pane? Should I link to the GitHub page 
  or to MediaFire?]
* On the "TSV Pane" of the submission form, add buttons to update the 
  "keyboard view" using the TSV code entered in the textarea boxes.
* On the submission form, should I use the "cleantextHTML" function to sanitize 
  the form inputs? What about in the other direction?
* If the "new game" box is checked, make sure the game title is different from 
  all the other game titles before allowing the user to submit the bindings.
* Instead of residing in the database, the "Blank Starter" binding scheme (or 
  something equivalent) should be auto-generated by pressing a "New" button.

### MediaWiki
* I should write/generate MediaWiki code for layouts and styles as well as 
  bindings.
* Should add support in the MediaWiki templates for toggling the numpad on/off. 
  [Ed. I may have actually done this already. Need to double check.]
* Add support in the MediaWiki template for Shift/CTRL/Alt command groups/colors.
* Currently, the MediaWiki output is limited to keys that have commands bound 
  to them. Should there be a setting that tells the script to output code for 
  every key and key modifier, even if no commands are bound to them?

### Auditing, Authors, Etc.
* Should create a table of authors/contributers that automatically pulls info 
  from the database. It should show a list of authors, and the stuff they 
  contributed to.
* I would like to audit changes to the database with a record of who made each 
  change and when. Recording what changes were made may be overkill, though.
* Auditing changes to the database might be easier if I wrote a front-end tool 
  for users to make the changes with, versus doing everything manually in MySQL 
  Workbench.
* Fix how the author names are rendered so they are not duplicated too many 
  times.

### Database Schema
* Make sure the "sort order" or "display order" columns are named the same 
  everywhere in the database. Currently, the following tables possess such a 
  column: "platform", "keygroups_dynamic". Candidate tables include 
  "stylegroups", "genres", "urlqueries", "formats".
* Right now it may merely be coincidental that the "bindings" and "positions" 
  match up to each other properly in the application. Need to make sure I am 
  not relying too much on hardcoded values for table length, and that the 
  order of the records in the database does not have an adverse effect on the 
  behavior of the application. [Ed. I don't recall if I am sorting the result 
  set by "key number" in PHP or not.]
* The "record_id" column name is used in two different contexts within the 
  database: once as a game record, and once as a style record. Should rename 
  each column to something different to avoid confusion. [Ed. this is true 
  for the "keygroup_id", "keygroup_class" and "contrib_id" columns belonging to 
  other tables as well.]
* I would like for the "command_text" column in the "commands" table to be set 
  to NOT NULL. But I will have to come up with something else to put into that 
  column when adding new "Additional Notes". Unlike the other command types, 
  the "Additional Notes" category is supposed to leave the left column blank. 
  When I overhauled the "commands" code I forgot to re-implement this special 
  case. I think that before the overhaul I was using an HTML TEXTAREA element 
  instead of the more common INPUT element for the "Additional Notes" sections 
  of the submissions form. Not sure how I want to flag to the various scripts 
  which sets of "commands" are the special cases and which are not. I may need 
  to add an additional binary column to the "commandtypes" table for this very 
  purpose. [Ed. the scripts now know which commands take two parameters and 
  which only have one. Still not sure how to set the second column to NOT Null,
  other than to split each command type into its own table.]
* On the submission form, the column names for the TSV data in the "Spreadsheet 
  View" should be fetched from the database instead of being hardcoded. OTOH, 
  the scripts expect the columns to be sorted in a particular order, and I'm 
  not sure when fetching the data from the database that the results will be 
  in a consistent order. [Ed. maybe the column names in MySQL are already 
  retrieved and outputted in a consistent order? I dunno. Will have to check.]
* The PHP and JS "color" and "class" tables are currently sorted by the index 
  columns of the "keygroups" tables in the database. But what happens if new 
  colors or classes are added? Or if the indexes somehow get corrupted? Can I 
  re-index the "keygroups" tables without affecting other tables with foreign 
  key constraints?
* Instead of having one genre per game, maybe I could create a tag cloud so 
  that a game can be placed in multiple genres? What type of GUI would this 
  necessitate? Is this even possible using MySQL? How granular should I get 
  with the video game genres? Should I list sub-genres and sub-sub-genres? How 
  many genres? Which genres?
* Rename the "commandlabels" table to "commandtypelabels" or something similar.
* Need someone to look over the PHP code and help determine whether the code is 
  susceptible to SQL injection.
* Double check whether I can replace any instances of PHP sorting with SQL 
  sorting, since the latter is supposedly faster.
* The "XXXX_group" columns in the "bindings" table are partially dependent on 
  the "XXXX_action" columns, and vice versa. So, I guess this table is not in  
  third normal form.

### Optimization
* Should maybe store the SVG patterns, filters and gradients in separate files 
  to be included only when needed, rather than cluttering up "chart-svg.php".
* Currently, all the SQL queries are very simple, and all processing of data is 
  done using PHP scripts. Some of these tasks could probably be performed more 
  efficiently using SQL joins. Not sure which ones however.
* Not sure every table needs its own numerical index column. Using two or more 
  preexisting columns to form a composite key might suffice in many cases.
* The HTML and JS output could be "minified" to save bandwidth. But I dislike 
  this practice and hate working with minified code. Plus, I am not exactly 
  hurting for bandwidth at this time, and pages currently load very quickly.

### Presentation
* Need to create a new favicon just for this project.
* Use flexbox or grid for the accordion containers instead of float or inline 
  box display.
* Maybe replace the "up", "down", "right" and "left" key captions with arrow 
  icons? (Or Unicode arrow characters?)
* Experiment again with scaling and rotating the diagrams so that they are 
  easier to display and print. [Ed. the last time I tried this it didn't work 
  in all browsers, IIRC.]
* Need to create one or more styles that are accessible to people with color-
  blindness.
* Since the main diagrams are now rendered in SVG instead of HTML, I could make 
  it so that the Enter keys on the European ISO layouts have the correct "L" 
  shape. I.e. a polygon with six vertices instead a rectangle with four 
  vertices. However, the database currently only stores a key's XY position, 
  width and height, not the coordinates of its vertices.
* Should the accordion menus on the front-end page be sorted alphabetically? 
  Or, should I add a "display_order" column to each SQL table? If I can come up 
  with an easy way to update such a "display_order" column using SQL commands, 
  then I may add one to each of the tables. Updating such a column manually 
  is a PITA right now, however.
* Maybe add some breadcrumbs or a navigation header to the "plain" pages?
* The "Patterned Grayscale" style really sucks and needs work.
* Radio buttons on the front page should be based on "em" dimensions instead of 
  pixel dimensions. [Ed. need to figure out how to set the size of the the "X" 
  icon using "em" values.]
* "Cube Snake" script looks awful in Google Chrome when displayed at anything 
  other than the monitor's native PPI. This is true even after size correction. 
  It looks okay in Firefox, though.
* I would prefer it if the "Cube Snake" script operated upon the page's BODY 
  element instead of a DIV element since the pages flicker a bit on first load. 
  However, the CSS scaling would then affect every object on the page instead 
  of just the background area. [Ed. need to check whether this script is 
  working correctly in other browsers, regardless.]

### Non-coding related
* File permissions recently started getting messed up when uploading new files 
  to the server over FTP. Is it a bug or setting in the FTP software, or is it 
  a configuration setting in the server? I now have to fix the permissions 
  manually each time I upload a brand new file. I need to figure out what is 
  going on.
* Set the correct server time zone. [Ed. my Web host does not allow this.]

### Miscellaneous
* I would like to also display charts/diagrams for gamepads, mice and 
  joysticks. But the sheer number of different devices may make this task 
  extremely difficult. I'm not sure what changes to the database I would need 
  to make. Also, the images of the devices would need to be static instead of 
  being generated dynamically as the keyboard diagrams are currently.
* Not sure whether the XML sitemap file should list each game once for every 
  game/platform/layout combination, or only once, period. Will it confuse 
  search engines if I list multiple URLs for each game?
* Now that I have ditched the HTML format in favor of SVG for the principal 
  rendering method, should I update the submission editor to use SVG as well? 
  This would require some cross-frame JavaScript, as well as some manner of 
  text input for the SVG files. Not sure this is going to be easy.
* Users should maybe be able to press the ALT, CTRL or SHIFT modifier keys and 
  see the bindings that make use of these modifiers highlighted somehow. There 
  is another project on the Internet that works in this manner. Need to check 
  it out.
* I should be able to easily create "Typing Reference" schemes for every 
  keyboard layout. I would like to have the GUI strings translated into their 
  respective languages before I do this, however.
* Not sure if the GUI language should be a per-layout setting, or something the 
  user can configure manually. The latter would require yet another URL query 
  parameter or even a cookie.
* Whether or not to show lower-case key caps should maybe be a per-game setting 
  rather than a per-layout setting. Or, allow users toggle them on/off 
  manually. Would this require more URL query parameters or cookies?
* I should maybe merge the "Done" tasks on this list back into the other 
  categories and use strike-through text to indicate whether a task has been 
  completed or not. Or, I could create a "Not Done" section and duplicate the 
  category sub-headings in the "Done" section. Lastly, I could use GitHub's 
  built-in "Issues" interface. Can GitHub "Issues" be categorized based on 
  criteria that I specify?
* Make sure there are no characters escaped in the HTML "title" tags since page 
  titles do not benefit from escaping characters. [Ed. currently I "clean" all 
  text strings of characters that can be escaped regardless of where they are 
  printed. I need to investigate exactly which HTML tags do and do not benefit 
  from "cleaning". This goes for SVG tags as well. Also, is there a library I 
  can utilize to do the cleaning versus coding everything myself?]
* Echo all HTML code using PHP in order to be consistent. [Ed. this way the 
  pages will be completely blank if a person navigates to them and the PHP code 
  does not execute for whatever reason.]
* Need to create an SVG equivalent of the "print_key_html" function.
* Investigate the various different backlit keyboards to see whether I can 
  support them as well. Maybe create an "Export" format that provides users 
  with a number of conversion tools.
* Need to remember to test all the pages in other browsers periodically! 
  BrowserStack offers a free service for open source projects, apparently. I 
  need to sign up for that.
* Should I refer to the "frontend page" as the "front page" instead from now 
  on? Which name is more appropriate? Should I rename the files too?
* Put a little comment note next to each query function listing which 
  parameters need to exist before the query function can be called.
* Why am I not using the "class_table" array? It was supposed to hold all the 
  class names for the "static" keygroups. What have I been doing instead? Maybe 
  I did not create it because I have only one use for the "static" class names, 
  whereas I have used the "color_table" array repeatedly.
* I don't think the Google Analytics code is working properly. It is spawning 
  errors in the browser console. I will have to take a note of and research the 
  error message next time I see them.
* Should tables like "$layout_authors" use the author ID as the index? Does it 
  matter?
* Maybe rename "stylegroup" to just "group" in PHP and JS?
* Create a separate "credits" page since the log is getting too long.
* Maybe I can squeeze some object-oriented design into this project?
* When I have more than one command for a particular key, I usually separate 
  them with a forward slash. Should I do this differently? Should I use a dash, 
  semicolon or comma? Should I use a bulleted or numbered list?

### Problematic
* The key caption legend should also be configurable. Right now it always says 
  "SHIFT", "CTRL", "ALT", etc. and can't be customized. Not sure which table to 
  put this stuff in. There will need to be a way to turn each string on and off 
  as well as insert a value.
* Some of the PHP and JS files should not be directly accessible via the Web.
  [Ed. this can be done easily for PHP files, but not JS or CSS files as far as 
  I can tell.]
* It would be nice to split the background coloring for when a key has more 
  than one use. For instance, one could subdivide each rectangular key into two 
  triangles and color each triangle differently. [Ed. this may be difficult to 
  implement in both HTML and SVG, and may confuse users.]
* It would be nice to stretch the text on each key so that it fits without the 
  need for line breaks, like in a spreadsheet program. [Ed. I don't think this 
  can be accomplished without lots of JavaScript, which I would rather avoid.]
* Experiment more with CSS effect filters. [Ed. May not work in all browsers.]
* There remain some meta header tags that have not been added to the PHP pages, 
  yet. [Ed. right now I can't remember which tags I was talking about, however.]
* On the submission form, replace key code labels such as "capnor" and "lowagr" 
  with actual English text. [Ed. space is at a premium. Not sure I can fit the 
  English text in there without stretching the page or triggering the addition 
  of a scroll bar.]
* Maybe the red in the "Warm" styles can be made deeper? [Ed. I tried this, but 
  it didn't look very nice.]
* Users of the submission form should be able to specify a layout using a drop-
  down list (or something similar) within the submission form itself. Users can 
  already select a "Blank Sample" for every layout from the frontend page. But 
  they should be able to do more. Or maybe add a "New" button to the submission 
  form that asks for some basic info and a desired layout, and then blanks 
  every field. [Ed. the latter would be much easier to do than the former.]
* I thought the ID for each key in the "positions" table was based on the IBM 
  position codes. However, apparently this is not the case. Should I edit the 
  position table so that they *are* based on the IBM position codes? [Ed. I 
  think the IBM position codes only go up to a certain number. IIRC, they don't 
  include a lot of the newer keys such as "Windows" or "Super" among others.]
* The background and sprite images used in "java-cubescatter.js" are based on a 
  hexagonal grid. However, the width-to-height ratio of a hexagon is 1:sqrt(3), 
  which is not a ratio of integers. Is there a way to alter the sprites somehow 
  to achieve greater precision? Can I scale and position sprites using decimal 
  values? [Ed. most browsers do in fact support fractional pixel dimensions. 
  However, I do not know if this is also true for an HTML element's background 
  property--especially a background composed of bitmap images. One alternative 
  might be to switch to 2:1 dimetric projection, in which case the width-to-
  height ratio becomes one of integers. Quite possibly I could also switch from 
  using bitmap images to using SVG images. But these would likely not work very 
  well in every Web browser.]

### Rejected
* Tweak the "cleantext" functions and/or the query functions so that separate 
  copies of every query function are no longer required for HTML and SVG.
  [Ed. after some testing, this ended up adding more complexity than it 
  eliminated.]
* The "$path_file" variable should be assigned automatically using a script. 
  [Ed. since so many PHP scripts are "included" inside the wrapper file, the 
  "$path_file" variable is the most reliable way to keep track of which is the 
  current file. It is needed in the footer time and date stamp for instance.]
* I would like to change the text shown in the color selection boxes of the 
  submission form from "non" to "null" or "nil" or something else. [Ed. this 
  might have adverse effects upon some scripts. Also, if I were to do this, 
  then the drop-down list would take up additional space in order to 
  accommodate the additional characters.]
* The "seourl" arrays and column could probably be replaced with a script that 
  automatically generates the needed strings. [Ed. need to make sure the output 
  in both cases is exactly the same.] [Ed. on second thought, I do reverse look-
  ups using the seourls, so this idea won't work.]
* I would like to re-index the "layouts" table since a gap exists between ID #1 
  and ID #3. [Ed. this would break many links on the Internet, however. Maybe 
  better to simply reuse the ID number for a new layout at some future point.]
* Can I shorten "foreach ($topic_array as $i => $topic_value)" to not include 
  the "$topic_value" part? [Ed. does not seem to be possible. Regardless, I now 
  find the "$topic_value" part useful.]
* Just rediscovered there is a new HTML5 element called "code". Could be 
  useful. [Ed. apparently the "code" and other phrase tags are not new, and are 
  sort of being deprecated.]

### Ongoing
* Double check all PHP and JS code for instances of the strings "counting!", 
  "cleaning!", "hardcoded!", "order!" and "non!". Problems may crop up at these 
  locations.
* Make sure JavaScript arrays line up prettily.
* Just for fun, run a script that counts and logs the number of lines of code.
  [Ed. I installed a freeware Windows tool called LocMetrics for this purpose. 
  It is a very easy tool to use. I am not sure how well it "understands" HTML, 
  JS and PHP code, however. The website says it supports "C#, C++, Java, and 
  SQL". I did not point the tool at the database dumps or these wiki documents.]
* Ideally, the project should still function as intended even if I have re-
  indexed the database! Make sure the PHP and JS tables are using the same 
  indexes as in the database. (Remember to subtract 1 however.)

### Done
* In the submission form, selecting a colored OPTION element should change the 
  color of the corresponding parent SELECT element as well.
* A warning should be thrown ONBEFOREUNLOAD if someone attempts to leave the 
  submission form and there is any unsaved or unsubmitted data.
* Make sure all buttons in the submission form have their TITLE attributes set 
  so that tooltips appear when hovering the mouse over them.
* The Creative Commons and GNU icons need to have their ALT attributes set.
* The CAPTCHA dialog should check for a correct security code *before* sending 
  the user on to the next page. At the very least, it should warn the user that 
  he or she will not be able to return to the form page after clicking the 
  submit button.
* Convert input TABLEs to DIVs.
* Need a loading icon since it takes a while for all the AJAX stuff (e.g. 
  reCAPTCHA) to download and load fully.
* The "required" attribute of the email INPUT elements should cause the 
  submission form to not post if those INPUTs are not filled properly. This 
  includes the email address field, which requires special syntax.
* The footer area is the same for many of the views. It could be stored in a 
  separate file and simply included when needed.
* It may be better to reverse the order of the selection dialogs on the front 
  page. E.g. select the Keyboard first, then the Style, and then the Game. 
  Otherwise, finding bindings for the German or French keyboards will be like 
  searching for a needle in a haystack.
* Remake the loading icon in animated WebP format. Does this graphics format 
  work properly in other browsers besides Google Chrome?
* Experiment with flexbox in the "CSS3 Testing" theme. The "Command" DIVs could 
  make use of it to automatically wrap or resize themselves based on the amount 
  of space available to them.
* Embedded icon images not showing up anymore. See the bindings for Homeworld 2 
  for an example.
* "Patterned Grayscale" theme has several newly-introduced issues since I 
  switched from HTML to SVG rendering. [Ed. On second thought, it's not so bad. 
  Maybe I will leave things the way they are.]
* Optgroup styles are messed up in dark/black themes in Firefox. [Ed. I ended 
  up removing all styling from the select lists and instead set them back to 
  their defaults.]
* Rename "html_XXXXX.css" files to "submit_XXXXX.css" and/or rename 
  "keyboard-html.php" to "keyboard-embed.php".
* The HTML editor should throw an error if a legend group has not been assigned 
  to each and every binding.
* Submission form may not be generating enough table columns for the "bindings" 
  table.
* Add a toggle to turn the numpad on and off.
* Maybe rename "Win" key to "Super" or "Meta" as per many Linuxes and custom 
  keyboards?
* Currently, the "layouts", "records_games" and "records_styles" tables each 
  have an "author_id" column. However, this column can only store a single 
  author ID whereas multiple people might have actually worked on an item.
* On the frontend page, replace the asterisk used to indicate "default" 
  selections with an icon of a star or something else.
* Move all "support" scripts to another directory, and use htaccess to block 
  all external access to them. [Ed. I created the "lib" directory, but I don't 
  think there's a way to block graphic images, javascript, css, etc. without 
  blocking the files everywhere else too.]
* Direct links to SVG file will not load other formats when changing the "fmt" 
  URL parameter. Conversely, changing the "fmt" URL parameter on a PHP page can 
  load an SVG file, but the extension remains PHP and does not change to SVG.
* I would like to move "keyboard-embed.php", "keyboard-svg.php", 
  "keyboard-wiki.php" and "keyboard-submit.php" into the "lib" directory. 
  However, there are issues involving paths to these files. When the files are 
  included inside "keyboard-chart.php", they are treated as if they were in the 
  same folder as "keyboard-chart.php". But when "keyboard-svg.php" is loaded 
  into an IFRAME in "keyboard-embed.php", it is correctly treated as if it were 
  in the "lib" directory. A lot of stuff gets messed up when this happens. One 
  solution might be to not use an IFRAME for the SVG files, but instead insert 
  the SVG code directly into the HTML wrapper file code. Or, maybe there is a 
  way to not include the files inside "keyboard-chart.php", and use some means 
  of changing the page location instead.
* The file "keyboard-sitemap.php" is a tool and does not need to use the site's 
  styling. It should also be moved into the "lib" directory.
* The TSV code on the "TSV Pane" of the submission form is not always 
  lining up neatly. Need to set the container to overflow instead of wrap.
* On the submission form the displayed value for "inp_keynum" should start at 
  one instead of zero like in the database. In JavaScript the number should 
  remain the same as it appears now, however.
* The submission form does not indicate anywhere which layout and style are 
  selected.
* Need to fetch the contents of the "colors" JavaScript array from the database 
  instead of hardcoding the values.
* Implement a "languages" table.
* The value of the "html" tag's "lang" attribute should be a short two-letter 
  string instead of an integer as it is now. It should not be hardcoded either.
* Some of the keyboard DIVs still have hardcoded inline styles. Search for 
  "width:1660px;height:480px;" in the submission form.
* On the submission form, I would like to draw an animated dotted line as the 
  border of the selected key.
* Rename the "contrib" tables to "contribs" in order to use a consistent naming 
  scheme.
* The "entities" table should be renamed to "url_queries" or something similar. 
  The current name is too ambiguous.
* None of the pages in this project should use my website's style. They should 
  all feature their own very minimal style without my site's branding. Needs to 
  link back to the rest of my site at least.
* Need to add "header", "footer", "main" and other HTML5 semantic tags to every 
  generated page.
* The "mouse", "joystick", "cheat code", etc. commands are named and described 
  in both the "commandtypes" table and the "languages" table. Can one of these 
  be eliminated? See the notes I wrote around the "resThisLanguageStrings" and 
  "resCommands" functions.
* Add a "Reset" button to the frontend page that resets the state of the forms.
* The "Create New Diagram" button on the front-end page should have a flat gray 
  style like the other form elements on the same page.
* "Spreadsheet View" needs to be renamed to something else since I have not 
  created an actual spreadsheet. Maybe "TSV View" would be a better name. 
  Alternatively, make the "TSV Pane" behave more like an actual spread-
  sheet. [Ed. officially the term "spreadsheet" has been removed from the page. 
  The button is labeled "Toggle TSV Panel" for now.]
* In "keyboard.php" the "sortGames()" function could be moved inside the actual 
  query function.
* Rename PHP and JS arrays from "xxxx_array" to "xxxx_table" wherever possible. 
  There may be some naming conflicts.
* Get rid of as many "count" variables like "$binding_count" as possible, and 
  replace them with "max" variables, and only use "max" variables sparingly.
* The functions "leadingZeros2" and "leadingZeros3" should be turned into a 
  single recursive function. [Ed. instead of making the function recursive, I 
  switched to using a native PHP function that serves the same purpose.
* The "$legend_count" PHP variable is hardcoded. Maybe needs to be calculated 
  based on size of "$color_array".
* Should the mouse, joystick, etc. commands be lined up neatly into pairs with 
  the left and right parts separated by an equal '=' sign? For instance using a 
  table? Or should I instead use a definition/description list? This should not 
  be too hard since I already store the left and right texts in separate fields 
  within the database itself. [Ed. using a table would be perfectly okay 
  semantically since it is tabular data. OTOH, a table would use up more space.]
* Several routines rely very heavily on the database tables not having gaps in 
  them. I need to either switch to using "foreach" and "for...in" loops instead 
  of numerical "for" loops, or start using "isset" and "array_key_exists" a lot 
  more often than I have been. Ditto for the JavaScript code. [Ed. I have 
  switched to using "foreach" and "for...in" wherever possible.]
* Currently, the MediaWiki format generates lines of code for keys that are not 
  used by a particular game. Should I not generate these lines of code? [Ed. I 
  edited the script to omit keys with no actions bound to them.]
* Rename the "game_friendlyurl" column to "game_seourl" in order to be 
  consistent and not confuse anybody.
* The "non" color should be added to the database. Need to also create a 
  "sort_order" column to ensure the colors are in the correct order.
* In "keyboard.php", maybe replace "$platform_first", "$stylegroup_first" and 
  "$genre_first" with some "default" value for each of the related tables? Do I 
  only want the first categories of the accordion menus to always be open when 
  the page loads? Also, keep in mind that I may create "sort_order" columns for 
  several tables in the future. [Ed. renamed the "urlqueries" database table 
  back to "entities" and added the default platform, stylegroup, genre and 
  language IDs to it.]
* I moved most PHP routines and SQL statements to two dedicated files. But this 
  may be worse for performance since only a subset of the routines are needed 
  at any given time, yet the entire files are loaded each time. Should I split 
  the two big files into several smaller ones? [Ed. scripts and queries have 
  been split into multiple smaller files.]
* Escape sequences not working properly in the SVG output.
* Create a new "GRID" URL parameter so that I can quickly override all the other 
  URL parameters in a pinch if needed.
* The "non" color needs to once again be removed from the database. Adding it 
  to the database was a mistake in the first place.
* Commands should have "keygroup_id" applied to them as well, even if I do not 
  display the colors. [Ed. this will be a time-consuming thing to retroactively 
  fix. Haven't decided yet whether the submission form should complain or not.]
* Need to add instructions to the effect that the SHIFT, ALT, etc. commands may 
  require colors assigned to them, but these colors will not necessarily be 
  displayed in the chart.
  [Ed. A pop-up warning does actually get spawned when this happens currently. 
  Is a single pop-up alert sufficient warning?]
* Automatically send confirmation emails to anyone who completes the submission 
  form. Also, do this for the email form on my main website too.
* The tables "contribs_layouts", "contribs_games" and "contribs_styles" are 
  missing time and date stamps properly indicating when items were added or 
  updated.
* The PHP scripts get kind of flaky when both an SEO string *and* a game ID are 
  specified in the URL. Not sure which should override the other. Need to 
  investigate further.
* I merged the HTML and SVG formats into one format. The diagrams are no longer 
  rendered using pure HTML code, and the SVG files are now once again embedded 
  within an HTML wrapper. (This is also how the old "embed" format worked.) Not 
  sure what effect using SVG will have on search engines, however. Do search 
  engines parse text embedded within SVG files? What if those SVG files are 
  also embedded within HTML files?
* "Formats" are now listed in the database. I can now use the database to 
  generate the format list in the page footer if I want to. The same is true 
  for the "urlqueries" table.
* Maybe add a checkbox to the submission form so that users can indicate to the 
  developers that bindings for a brand new game are being created. The 
  "record_id" field should then read as "\N" for each record instead of an 
  existing game's ID. At the very least, a button to load the "Blank Sample" 
  should be added to the frontend page. [Ed. I added the checkbox, but it has 
  no effect until the user tries to submit the schema via the email form and 
  captcha. It is not reflected in the TSV output in the "TSV Pane".]