/**
 * Helpers
 */


    function price(price){
        price = parseFloat(price);
        if(isNaN(price)) price = 0;
        return `${price.toFixed(2)} zł`;
    }


/**
 * Cart
 */
const cartWidget = {
    is_show : false,
    show(){
        if(this.is_show) return;
        this.is_show = true;
        $('.cart-wrapper').show();
    },
    hide(){
        if(!this.is_show) return;
        this.is_show = false;
        $('.cart-wrapper').hide();
    },
    setPosition(){
        let offset = $('.cart-button').offset();
        let btnWidth = $('.cart-button').width();
        let cartWidth = $('.cart-wrapper').width();

        let left = (offset.left + (btnWidth/2)) - (cartWidth/2);
        $('.cart-wrapper').css('left',left);

    }
}

const cart = {
    changeDelivery(el){
        console.log(window);
        let delivery = $(el);
        let productsPrice = parseFloat($('#price_products').data('sum'));
        let deliveryPrice = parseFloat(delivery.data('price'));
        $('#price_delivery').text(price(deliveryPrice));
        $('#price_sum').text(price(deliveryPrice+productsPrice));
        $("#delivery_data").val("");
        $(".btn-paczkomat").text("Wybierz paczkomat");
    },
    showInpostModal(btn){
        easyPack.init({})
        easyPack.modalMap(function(point, modal) {
            modal.closeModal();
            $(btn).html(point.name);
            $("#delivery_data").val(point.name);
        }, { width: 500, height: 600 });
    },
    updateAmounts(){
        $("#formCart").attr("action","/cart/update").submit();
    }
}



/**
 * Katalog
 */
const catalog = {
    url : new URI(),
    params : {
        tags : [],
        price : {
            min : 0,
            max : 0
        },
        page : 0,
        search : ''
    },
    redirect(url){
        window.location = url;
    },
    getFilters(){
        let params = this.url.query(true);
        let price_min = $('input[name="price_min"]').val().replace(",",".").trim() || 0;
        let price_max = $('input[name="price_max"]').val().replace(",",".").trim() || 0;
        let page = params.page || false;
        let search =$('.search-filtr[name="search"]').val() ?  $('.search-filtr[name="search"]').val().trim() : false;

        let tags = $('input[name="tags"]:checked').each((index,el) => {
            console.log($(el));
            let attribute_id = $(el).data('attribute');
            let value_id = $(el).data('value');
            this.params.tags.push({
                attribute_id,
                value_id
            });
        });

        this.params.price.min = price_min;
        this.params.price.max = price_max;
        this.params.page = page;
        this.params.search = search;
    },
    createUrl(){
        // let newUrl = new URI(this.url.origin());
        this.url.removeSearch(["price", "tags", "search"]);

        if(parseFloat(this.params.price.min) > 0 || parseFloat(this.params.price.max) > 0 ){
            this.url.setQuery(`price`,`${this.params.price.min},${this.params.price.max}`)
        }

        if(this.params.tags.length > 0){
            let tag_query = [];
            this.params.tags.forEach(val=>{
                // console.log(val);
                tag_query.push(`${val.attribute_id}:${val.value_id}`);
            });

            this.url.setQuery(`tags`,tag_query.join(','));
        }
        if(this.params.page){
            this.url.setQuery(`page`,this.params.page)
        }

        if(this.params.search){
            this.url.setQuery(`search`,this.params.search)
        }

        // console.log(this.url.readable());
        // return;
        this.redirect(this.url.readable())
    },
    click(){
        this.getFilters();
        this.createUrl();
    },
    setFilters(){
        let price_min = null;
        let price_max = null;

        let params = this.url.query(true);
        let price = params.price || false
        let tags = params.tags || false
        if(price){
            price = price.split(",");
            price_min = price[0];
            price_max = price[1];
        }
        if(tags){
            let tag_query = tags.split(',');
            tag_query.forEach(element => {
                let tag = element.split(':');
                let attribute_id = tag[0];
                let value_id = tag[1];
                console.log(attribute_id);
                $(`input[name="tags"][data-attribute="${attribute_id}"][data-value="${value_id}"]`).prop( "checked", true );
            });
        }
        $('input[name="price_min"]').val(price_min);
        $('input[name="price_max"]').val(price_max);
    }
}


 $(document).ready(function () {
     $('.menu_links .cart-button').mouseenter(function(){
         cartWidget.show();
     })
     $('.cart-wrapper').mouseleave(function(){
        cartWidget.hide();
     })

     if($('.cart-wrapper').length){
        cartWidget.setPosition();
     }



 });
 if($('.cart-wrapper').length){
    $(window).resize(function () {
        cartWidget.setPosition();
    });
 }
