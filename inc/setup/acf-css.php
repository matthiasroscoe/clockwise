<style>
/* Decreasing default WYSWIWYG editor height */
.acf-field[data-type="wysiwyg"] iframe{
    height: 200px !important;
}

/* Proper formatting for select field used in the Amenities module */
.select2-results__option,
.select2-selection__rendered {
    display: flex !important;
    align-items: center;
}
.select2-results__option img,
.select2-selection__rendered img {
    width: 20px;
    padding-right: 10px;
}
.select2-results__option--highlighted img {
    filter: invert(1) brightness(2);
}



</style>