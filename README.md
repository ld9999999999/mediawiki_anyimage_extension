MediaWiki Any Image
===================

Use any type of image (such as SVG) within the &lt;img> tag inside MediaWiki.

MediaWiki doesn't support a number of image formats, namely embedded SVG. This extension allows you to insert any image file as within the `<img>` tag.

## Use

Add to Localsettings.php:

     include("$IP/extensions/AnyImage.php");
     
In your wiki entry:


   `<anyimage src="file.svg" width="100" height="100" class="something" scalew="200"></anyimage>`
      
      src = name of the image
      width = original image width
      height = original image height
      class = css class
      scalew = desired scaled width (height will be calculated automatically)

