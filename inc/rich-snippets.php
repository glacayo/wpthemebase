<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "<?php the_field('schema_category_homeandconstructionbusiness', 'option'); ?>",
      "image": [
        "<?php echo 'http:' . esc_url(get_field('schema_banner_image', 'option')); ?>"
       ],
      "@id": "<?php the_field('schema_id_website', 'option'); ?>",
      "name": "<?php the_field('schema_company_name', 'option'); ?>",
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        <?php
        $offercatalog = get_field('schema_services_list', 'option');
        if( $offercatalog ): ?>
        "name": "<?php echo $offercatalog['schema_service_offercatalog']; ?>",
        <?php endif; ?>
        "itemListElement": [
        <?php 
        $SchemaServices = get_field('schema_services_list', 'option')['schema_services'];
        $last_key = end($SchemaServices);
        foreach($SchemaServices as $key => $value){
            if ($key == $last_key) { ?>
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "<?php echo $value['schema_service']; ?>"
                }
            }
            <?php } else { ?>
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "<?php echo $value['schema_service']; ?>"
                }
            },
        <?php } ?>
        <?php } ?>                                                           
        ]
      },
      "address": {
        "@type": "PostalAddress",
        <?php
        $PostalAddress = get_field('schema_location', 'option');
        if( $PostalAddress ): ?>
        "streetAddress": "<?php echo $PostalAddress['schema_address']; ?>",
        "addressLocality": "<?php echo $PostalAddress['schema_address_locality']; ?>",
        "addressRegion": "<?php echo $PostalAddress['schema_address_region']; ?>",
        "postalCode": "<?php echo $PostalAddress['schema_postal_code']; ?>",
        "addressCountry": "<?php echo $PostalAddress['schema_address_country']; ?>"
        <?php endif; ?>
      },
      "review": {
        "@type": "Review",
        <?php
        $review = get_field('schema_review', 'option');
        if( $review ): ?>
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": "<?php echo $review['schema_rating_value']; ?>",
          "bestRating": "<?php echo $review['schema_best_rating']; ?>"
        },
        "author": {
          "@type": "Person",
          "name": "<?php echo $review['schema_name_review']; ?>"
        }
        <?php endif; ?>
      },
      "geo": {
        "@type": "GeoCoordinates",
        <?php if( $PostalAddress ): ?>
        "latitude": <?php echo $PostalAddress['schema_latitude']; ?>,
        "longitude": <?php echo $PostalAddress['schema_longitude']; ?>
        <?php endif; ?>
      },
      "areaServed": [
                    <?php 
                    $areaServed = get_field('schema_cover_area', 'option')['schema_areas_served'];
                    $last_key = end($areaServed);
                    foreach($areaServed as $key => $value){
                        if ($key == $last_key) { ?>
                        "<?php echo $value['schema_area_served']; ?>"
                        <?php } else { ?>
                        "<?php echo $value['schema_area_served']; ?>",
                    <?php } ?>
                    <?php } ?>  
      ],
      "url": "<?php the_field('schema_company_url', 'option'); ?>",
      "telephone": "+<?php the_field('schema_company_telephone', 'option'); ?>",
      "email": "mailto:<?php the_field('schema_company_email', 'option'); ?>",
      "servesCuisine": "American",
      "priceRange": "$$$",
      "paymentAccepted":"<?php the_field('schema_company_payment_accepted', 'option'); ?>",
      "openingHoursSpecification": [
        <?php 
        $openingHoursSpecification = get_field('schema_open_hours', 'option')['schema_openinghoursspecification'];
        $last_key = end($openingHoursSpecification);
        foreach($openingHoursSpecification as $key => $value){
        if ($key == $last_key) { 
        ?>          
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": "<?php echo $value['schema_dayofweek']; ?>",
          "opens": "<?php echo $value['schema_opens_hour']; ?>",
          "closes": "<?php echo $value['schema_closes_hour']; ?>"
        }
        <?php }else{ ?>
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": "<?php echo $value['schema_dayofweek']; ?>",
          "opens": "<?php echo $value['schema_opens_hour']; ?>",
          "closes": "<?php echo $value['schema_closes_hour']; ?>"
        },
        <?php } ?>
        <?php } ?> 
      ],
      "sameAs": [
        "<?php echo get_field('social_items', 'option')[1]['link']; ?>",
        "<?php echo get_field('social_items', 'option')[0]['link']; ?>"
      ]
    }
</script>