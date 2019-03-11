<?php
	echo
"			<div class=\"bodiv\">
					<p><a target=\"_blank\" rel=\"license\" href=\"https://www.gnu.org/licenses/lgpl-3.0.en.html\"><img alt=\"GNU LGPLv3 icon\" src=\"" . $path_root . "images/license_lgpl_88x31.png\" /></a><a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/3.0/\"><img alt=\"CC BY-SA 3.0 icon\" style=\"border-width:0;\" src=\"" . $path_root . "images/license_cc-by-sa_88x31.png\" /></a></p>
					<p>&quot;Video Game Keyboard Diagrams&quot; software was created by Michael Horvath and is licensed under <a target=\"_blank\" rel=\"license\" href=\"https://www.gnu.org/licenses/lgpl-3.0.en.html\">GNU LGPLv3</a> or later license. Content is licensed under <a target=\"_blank\" href=\"https://creativecommons.org/licenses/by-sa/3.0/\">CC BY-SA 3.0</a> or later license. You can find this project on <a target=\"_blank\" href=\"https://github.com/mjhorvath/vgkd\">GitHub</a>.</p>
				<p>\n";
	if (($gamesrecord_author) && ($gamesrecord_author != "Michael Horvath"))
	{
		echo
"Binding scheme created by: " . $gamesrecord_author . ". ";
	}
	if (($layout_author) && ($layout_author != "Michael Horvath"))
	{
		echo
"Keyboard layout created by: " . $layout_author . ". ";
	}
	if (($stylesrecord_author) && ($stylesrecord_author != "Michael Horvath"))
	{
		echo
"Style design created by: " . $stylesrecord_author . ". ";
	}
	echo
"				</p>
				<p>Return to <a href=\"keyboard.php\">Video Game Keyboard Diagrams</a>. View the <a href=\"keyboard-list.php\">master list</a>. Having trouble printing? Take a look at <a href=\"keyboard.php#print_tips\">these printing tips</a>.</p>
";
	// style switcher
	echo
"				<form name=\"VisualStyleSwitch\">
					<label for=\"stylesel\">Visual style:</label>
					<select class=\"stylechange\" id=\"stylesel\" name=\"style\">\n";
	for ($i = 0; $i < count($style_table); $i++)
	{
		$style_row = $style_table[$i];
		if ($style_row[0])
		{
			$style_idx = $style_row[0];
			$style_nam = cleantextHTML($style_row[1]);
			if ($style_id == $style_idx)
			{
				echo
"						<option value=\"" . $style_idx . "\" selected>" . $style_nam . "</option>\n";
			}
			else
			{
				echo
"						<option value=\"" . $style_idx . "\">" . $style_nam . "</option>\n";
			}
		}
	}
	echo
"					</select>
					<input class=\"stylechange\" type=\"radio\" name=\"tech\" id=\"rad0\" value=\"0\"" . ($format_id == 0 ? " checked " : "") . "/>&nbsp;<label for=\"rad0\">HTML</label>
					<input class=\"stylechange\" type=\"radio\" name=\"tech\" id=\"rad1\" value=\"1\"" . ($format_id == 1 ? " checked " : "") . "/>&nbsp;<label for=\"rad1\">SVG</label>
					<input class=\"stylechange\" type=\"radio\" name=\"tech\" id=\"rad2\" value=\"2\"" . ($format_id == 2 ? " checked " : "") . "/>&nbsp;<label for=\"rad2\">MediaWiki</label>
					<input class=\"stylechange\" type=\"radio\" name=\"tech\" id=\"rad3\" value=\"3\"" . ($format_id == 3 ? " checked " : "") . "/>&nbsp;<label for=\"rad3\">Editor</label>
					<input class=\"stylechange\" type=\"radio\" name=\"tech\" id=\"rad4\" value=\"4\" disabled />&nbsp;<label for=\"rad4\"><s>PDF</s></label>
					<input class=\"stylechange\" type=\"button\" value=\"Change\" onclick=\"reloadThisPage('" . $game_id . "', '" . $layout_id . "', '" . $game_seo . "');\" />
				</form>
				<p>" . getFileTime($path_file) . "</p>
			</div>\n";
?>