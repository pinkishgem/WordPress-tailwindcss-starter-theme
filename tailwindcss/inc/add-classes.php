<?php

/**
 * /inc/add-classes.php
 *
 **/

/**
 * Finds specific html elements in the page and post content and adds appropriate Tailwinds classes
 * Variables are prefixed with the theme slug to avoid conflicts with other themes and plugins
 */
 function tailwindcss_add_classes($tailwindcss_enter_content){

         $tailwindcss_content = mb_convert_encoding($tailwindcss_enter_content, 'HTML-ENTITIES', "UTF-8");
         $tailwindcss_document = new DOMDocument();
         libxml_use_internal_errors(true);
         if ( $tailwindcss_enter_content == "" ) {
           return;
         } else {
           $tailwindcss_document->loadHTML($tailwindcss_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

           /**
           * Add Tailwinds classes to Image elements to fix Image Appearance in posts
           */

           // Get all of these elements in the post or page content
           $tailwindcss_imgs = $tailwindcss_document->getElementsByTagName('img');

           // Get all their classes
           foreach ($tailwindcss_imgs as $tailwindcss_img) {
              $tailwindcss_img_classes = $tailwindcss_img->getAttribute('class');

               // Add these classes to the list
              $tailwindcss_new_classes = $tailwindcss_img_classes.' max-w-full h-auto';
              $tailwindcss_img->setAttribute('class', $tailwindcss_new_classes);
           }

           /**
           * Add Tailwinds classes to Figure elements
           */
           $tailwindcss_figures = $tailwindcss_document->getElementsByTagName('figure');
           foreach ($tailwindcss_figures as $tailwindcss_figure) {
              $tailwindcss_fig_classes = $tailwindcss_figure->getAttribute('class');
              $tailwindcss_new_fig_classes = $tailwindcss_fig_classes.' max-w-full h-auto';
              $tailwindcss_figure->setAttribute('class', $tailwindcss_new_fig_classes);
           }

           /**
           * Add Tailwinds classes to style Tables elements
           * Tailwinds classes are added before existing classes for easy cascading
           */
           $tailwindcss_tables = $tailwindcss_document->getElementsByTagName('table');
           foreach ($tailwindcss_tables as $tailwindcss_table) {
              $tailwindcss_table_classes = $tailwindcss_table->getAttribute('class');
              $tailwindcss_new_table_classes = 'border-r-2 border-black b--black-10 py-2 px-4 '.$tailwindcss_table_classes;
              $tailwindcss_table->setAttribute('class', $tailwindcss_new_table_classes);
           }
           $tailwindcss_theaders = $tailwindcss_document->getElementsByTagName('thead');
           foreach ($tailwindcss_theaders as $tailwindcss_theader) {
              $tailwindcss_theader_classes = $tailwindcss_theader->getAttribute('class');
              $tailwindcss_new_theader_classes = 'py-2 px-4 text-left uppercase border-black '.$tailwindcss_theader_classes;
              $tailwindcss_theader->setAttribute('class', $tailwindcss_new_theader_classes);
           }
           $tailwindcss_theads = $tailwindcss_document->getElementsByTagName('th');
           foreach ($tailwindcss_theads as $tailwindcss_thead) {
              $tailwindcss_thead_classes = $tailwindcss_thead->getAttribute('class');
              $tailwindcss_new_thead_classes = 'py-2 px-4 text-left uppercase '.$tailwindcss_thead_classes;
              $tailwindcss_thead->setAttribute('class', $tailwindcss_new_thead_classes);
           }
           $tailwindcss_trows = $tailwindcss_document->getElementsByTagName('tr');
           foreach ($tailwindcss_trows as $tailwindcss_trow) {
              $tailwindcss_trow_classes = $tailwindcss_trow->getAttribute('class');
              $tailwindcss_new_trow_classes = 'bg-grey-lightest '.$tailwindcss_trow_classes;
              $tailwindcss_trow->setAttribute('class', $tailwindcss_new_trow_classes);
           }
           $tailwindcss_tdivs = $tailwindcss_document->getElementsByTagName('td');
           foreach ($tailwindcss_tdivs as $tailwindcss_tdiv) {
              $tailwindcss_tdiv_classes = $tailwindcss_tdiv->getAttribute('class');
              $tailwindcss_new_tdiv_classes = 'py-2 px-4 '.$tailwindcss_tdiv_classes;
              $tailwindcss_tdiv->setAttribute('class', $tailwindcss_new_tdiv_classes);
           }

           $tailwindcss_html = $tailwindcss_document->saveHTML();
           return $tailwindcss_html;
         }
 }
 add_filter('the_content', 'tailwindcss_add_classes');

?>
