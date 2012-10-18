(function($) {

    function ShindiriItem(element, options) {
        this.$item = $(element);
		this.$parent = options.$parent;
		this.options = options;
        this.$trigger = this.$(options.trigger);
        this.$close = this.$('.close');
        this.$info = this.$(options.moreInfo);
		this.$trigger_text = this.$trigger.find('.team_member_square_text_wrapper');
		this.$team_member_about = this.$info.find('.team_member_about');

		this.$trigger.on('click', $.proxy(this.show, this));
        this.$close.on('click', $.proxy(this.close, this));
        options.$overlay.on('click', $.proxy(this.close, this));
    };
    ShindiriItem.prototype = {
        show: function(e) {
            e.preventDefault();

			if (!this.$parent.data('in_trans'))
			{
				if (!this.$item.data('showed'))
				{
					this.$parent.data('in_trans', 1);
					this.$item.data('showed', 1);
					var item_position = this.$item.position();
					var trigger_text_position;
					var this_backup=this;
					if (item_position.top>0 && this.$parent.width()>=640)
					{
						this.$item.data('moved', item_position.top);
						var top_string='-'+item_position.top+'px';
						var speed=this.options.rolling_down_speed+(item_position.top/160)*100;
						this.$item.animate({top: top_string}, speed, this.options.easing, function(){
							trigger_text_position = this_backup.$item.height() - this_backup.$trigger_text.height();
							this_backup.$trigger_text.data('top', trigger_text_position);
							this_backup.$trigger_text.css('top', trigger_text_position);
							this_backup.$trigger_text.css('bottom', 'auto');
							this_backup.$trigger_text.animate({'top': 0}, 'slow');
						});
					}
					else
					{
						trigger_text_position = this_backup.$item.height() - this_backup.$trigger_text.height();
						this_backup.$trigger_text.data('top', trigger_text_position);
						this_backup.$trigger_text.css('top', trigger_text_position);
						this_backup.$trigger_text.css('bottom', 'auto');
						this_backup.$trigger_text.animate({'top': 0}, 'slow');
					}
		            this.$item.addClass('team_member_block_selected');
					var height_backup=this.$info.css('height');
					this.$info.css('height', 0);
					this.$info.show();
					this.$team_member_about.mCustomScrollbar("update");
					this.$info.animate({height:height_backup}, 'slow', this.options.easing, function()
					{
						this_backup.$parent.data('in_trans', 0);
					});
				}
			}
        },
        close: function(e) {
            e.preventDefault();

			if (!this.$parent.data('in_trans'))
			{
				if (this.$item.data('showed'))
				{
					var this_backup=this;
		            this.$info.hide();
					var trigger_text_position_top = this_backup.$item.height() - this_backup.$trigger_text.height();
					this_backup.$item.removeClass('team_member_block_selected');							
					if (this.$item.data('moved'))
					{
						var top_backup=this.$item.data('moved');
						var speed=this.options.going_up_speed+(top_backup/160)*100;
						this.$item.data('moved', 0);
						this.$item.animate({'top': 0}, speed, this.options.easing, function()
						{
							this_backup.$trigger_text.animate({'top': trigger_text_position_top}, 'slow');
						});
					}
					else
					{
						this_backup.$trigger_text.animate({'top': trigger_text_position_top}, 'slow');
					}
					this.$item.data('showed', 0);
				}
			}
        },
        $: function (selector) {
            return this.$item.find(selector);
        }
    };

    function Shindiri(element, options) {
        var self = this;
        this.options = $.extend({}, $.fn.Shindiri.defaults, options);
        this.$element = $(element);
        this.$overlay = this.$('.our_team_module_shade');
        this.$items = this.$(this.options.block);
        this.$triggers = this.$(this.options.trigger);
        this.$closes = this.$('.close');
   
        this.$triggers.on('click', $.proxy(this.overlayShow, this));
        this.$closes.on('click', $.proxy(this.overlayHide, this));
        this.$overlay.on('click', $.proxy(this.overlayHide, this));

        $.each( this.$items, function(i, element) {
            new ShindiriItem(element, $.extend(self.options, {$overlay: self.$overlay, $parent: self.$element }) );
        });
    };

    Shindiri.prototype = {
        $: function (selector) {
            return this.$element.find(selector);
        },
        overlayShow: function() {
            this.$overlay.fadeIn('slow');
        },
        overlayHide: function() {
			if (!this.$element.data('in_trans'))
			{
				this.$overlay.fadeOut('slow');
			}
        }
    };

    $.fn.Shindiri = function ( option ) {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('tooltip'),
                options = typeof option == 'object' && option;

            data || $this.data('tooltip', (data = new Shindiri(this, options)));
            (typeof option == 'string') && data[option]();
        });
    };

    $.fn.Shindiri.Constructor = Shindiri;
    $.fn.Shindiri.defaults = {
        block:     '.team_member_block',
        trigger:   '.team_member_square',
        moreInfo:  '.team_member_block_extended',
		rolling_down_speed:		300,
		going_up_speed:			500,
		easing:					'swing'
    };

})(jQuery);


$(window).load(function() {
	$("span.team_member_about").mCustomScrollbar();
});
