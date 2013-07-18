<?php
/*
 * License: BSD. Free to use for whatever purpose.
 *
 * Embeds a file as an <img> within the page.
 * Usage:
 *   <anyimage src="file.svg" width="100" height="100" class="something" scalew="200"></anyimage>
 *    src = name of the image
 *    width = original image width
 *    height = original image height
 *    class = css class
 *    scalew = desired scaled width (height will be calculated automatically)
 */

$wgExtensionFunctions[] = "wfAnyImage";

function wfAnyImage() {
   global $wgParser;
	 $wgParser->setHook( "anyimage", "returnAnyImage" );
}

function returnAnyImage( $code, $argv)
{
	$source = array_key_exists("src", $argv) ? $argv["src"] : "";
	$class = array_key_exists("class", $argv) ? $argv["class"] : "";
	$width = array_key_exists("width", $argv) ? $argv["width"] : "";
	$height = array_key_exists("height", $argv) ? $argv["height"] : "";
	$scalewidth = array_key_exists("scalew", $argv) ? $argv["scalew"] : "";

	if (is_numeric($scalewidth) && is_numeric($width) && is_numeric($height)) {
		$w = intval($width);
		$h = intval($height);
		$sw = intval($scalewidth); // desired width;
		$h = intval($h * (floatval($sw)/floatval($w)));

		$width = strval($sw);
		$height = strval($h);
	} else {
		if (!is_numeric($width)) {
			$width = "";
		}
		if (!is_numeric($height)) {
			$height = "";
		}
	}

	if ($source == "") {
		return "";
	}
	$source = htmlentities($source);
	$file = wfFindFile($source);
	if ($file == NULL) {
		return "";
	}
	$url = $file->getUrl();
	$href = $file->getDescriptionUrl();

	$style = "";
	if ($width != "") {
		$style = "style='width:${width}px;";
		if ($height != "") {
			$style .= "height:${height}px;";
		}
		$style .= "'";
	} else if ($height != "") {
		$style= "style='height:${height}px;'";
	}

	$class = htmlentities($class);

	$txt = "<a href=\"${href}\">" .
	       "<img src=\"${url}\" " . ($class != "" ? "class=\"${class}\" ": "") . "${style}>" .
	       "</a>";
	return $txt;
}

?>
