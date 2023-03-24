export default function SelectIsotope() {
    var $grid = $('.filtr-container').isotope({
        itemSelector: '.filtr-item'
    });

    // store filter for each group
    var filters = {};

    $('.data-selector').change(function () {

        var $this = $(this);
        var filterGroup = $this.attr('data-filter-group');

        // $("select option").attr('disabled', 'disabled');
        $(".filter-all").removeAttr('disabled', 'disabled');

        filters[filterGroup] = $('option:selected', this).attr('data-filter');
        //var filters = $('option:selected', this).attr('data-filter');

        // combine filters
        var filterValue = concatValues(filters);

        // set filter for Isotope
        $grid.isotope({ filter: filterValue });
    });

    $grid.isotope('on', 'layoutComplete', function () {

        var elems = $grid.isotope('getFilteredItemElements');
        console.log(elems.length + ' filtered items');
        // elems = $grid.find('.filtr-item');

        $(elems).each(function () {
            var filterClass = $(this).attr("class");
            var filterClassArray = filterClass.split(' ');
            console.log(filterClassArray);

            jQuery.each(filterClassArray, function (i, val) {
                $('[data-filter=".' + val + '"]').removeAttr('disabled', 'disabled');
            });

        });

    });


    // flatten object by concatting values
    function concatValues(obj) {
        var value = '';
        for (var prop in obj) {
            value += obj[prop];
        }
        return value;
    }

    $('.button--reset').on('click', function () {
        // reset filters
        filters = {};
        $grid.isotope({ filter: '*' });
        // reset selects
        $('.data-selector').val('');
        $('.data-selector option').removeAttr('disabled');
        $('.data-selector').prop('selectedIndex', 0);
    });
}