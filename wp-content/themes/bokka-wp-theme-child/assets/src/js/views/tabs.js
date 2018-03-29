module.exports = Backbone.View.extend({
    current: 0,
    events: {
        'click .tab-links a'   : 'handleClick'
    },
    initialize : function(){

        var self = this
        this.options = this.$el.data('options')
        this.tabs = this.$el.find('.tab-body')
        this.current = 0
        this.images = this.$el.find('img')
        var imageCount = this.images.length
        var loadedImages = 0

        if (navigator.userAgent.indexOf('MSIE 10.0') > -1) {
            this.images.each(function () {
                $(this).attr('src', this.src + '?' + new Date().getTime());
            });
        }

        //broload images before resize
        this.images
            .on('load', function() {
                if( loadedImages === (imageCount - 1)){
                    self.render()
                } else {
                    loadedImages++
                }
            })
            //resize for cached images too!
            .each(function() {
                if(this.complete) {
                    if( loadedImages === (imageCount - 1)){
                        self.render()
                    } else {
                        loadedImages++
                    }
                }
            })
    },
    render : function(){
        var self = this
        this.setTabByHash();
        this.setHeight()
        $(window).on('resize', function(){
            self.setHeight()
        })
    },
    setTabByHash: function () {
        var self = this;
        var hash = window.location.hash.substr(1);
        var location = 0;

        if ($('#product-listings').length > 0) {
            location = $('#product-listings').offset().top;
        }
        
        if (hash.indexOf('tab-') > -1) {
            if (location !== 0) {
                window.scrollTo(0, location);
            }
            self.$el.find('.tab#' + hash + ' a').trigger('click');
        }
    },
    setHeight : function(){
        var self = this

        if(bokka.breakpoint.value == "desktop") {
            this.$el.find('.tab-bodies').get(0).style.height = 'auto'
            this.$el.find('.tab-body').css('display','none')
            this.$el.find('.tab-body').eq(this.current).css('display','block')
            if (this.options && this.options.height) {
                if (this.options.height === 'container') {
                    var height = self.$el.parent().height()
                    this.$el.find('.tab-bodies').height(height)
                }
            } else {
                var maxHeight = 0
                var heights = []
                _.each(this.tabs, function (item) {
                    $(item).data('height', $(item).outerHeight());
                    heights.push($(item).outerHeight())
                })
                maxHeight = Math.max.apply(Math, heights)

                var newTab = this.$el.find('.tab-body').eq(this.current);
                if ($(newTab).data('height')) {
                    this.$el.find('.tab-bodies').height($(newTab).data('height'));
                } else {
                    this.$el.find('.tab-bodies').height(maxHeight)
                }
            }
        } else {
            this.$el.find('.tab-bodies').get(0).style.height = 'auto'
            self.tabs.fadeIn()
        }
    },
    changeTab : function(index){
        var newer = this.$el.find('.tab-body').eq(index)
        var old = this.$el.find('.tab-body').eq(this.current)
        this.$el.find('.tab-bodies').height($(newer).data('height'));
        this.current = index

        $(newer).fadeIn()
        $(old).fadeOut()
    },
    handleClick : function(event){
        event.preventDefault()
        var index = $(event.target).closest('li').index()
        if(index !== this.current) {
            this.$el.find('.active').removeClass('active')
            $(event.target).closest('li').addClass('active')
            this.changeTab(index, this.current, 'forward')
        }
    }
})