/**
 * @name	jWizard Plugin
 * @author	Dominic Barnes
 * @desc	A wizard plugin that actually works with minimal configuration. (per jQuery's design philosophy)
 * @type	jQuery
 * @version	0.5b
 */
(function($){
	var jWizard = function(element, options) {
		var defaults = {
			startStep: 0,
			enableThemeRoller: false,
			hideTitle: false,
			enableCounter: false,
			counterType: 'count',

			/* Button Rules */
			hideCancelButton: false,
			hideButtons: false,
			finishButtonType: 'button',
			buttonText: {
				cancel: 'Cancel',
				previous: 'Previous',
				next: 'Next',
				finish: 'Finish'
			},

			/* Menu Rules */
			enableMenu: false,
			menuWidth: '10em',

			/* CSS Classes */
			cssClasses: {
				title: 'title',
				menu: {
					div: 'menu',
					active: 'active',
					current: 'current',
					inactive: 'inactive'
				},
				steps: {
					wrapper: 'stepwrapper',
					all: 'step'
				},
				counter: 'counter',
				buttons: {
					div: 'buttons',
					cancel: 'wizardButton',
					previous: 'wizardButton',
					next: 'wizardButton',
					finish: 'wizardButton'
				}
			},

			/* Events */
			events: {
				onCancel: function(e) { return true; },
				onFinish: function(e) { return true; }
			}
		};

		/* Assign our Default Parameters (override with anything the end-user supplies) */
		var options = $.extend(true, {}, defaults, options);

		var w = $(element);	// Create a reference to the wizard itself

		// Assign some strings here so we can easily call on them again (rather than running those crazy concats all the time)
		var tmpMenuDiv = 'div.' + options.cssClasses.menu.div;
		var tmpStepwrapperDiv =  'div.' + options.cssClasses.steps.wrapper;
		var tmpStepsDiv = 'div.' + options.cssClasses.steps.all;
		var selectors = {
			title: {
				div: 'div.' + options.cssClasses.title
			},
			menu: {
				div: tmpMenuDiv,
				active: tmpMenuDiv + ' li.' + options.cssClasses.menu.active,
				current: tmpMenuDiv + ' li.' + options.cssClasses.menu.current,
				inactive: tmpMenuDiv + ' li.' + options.cssClasses.menu.inactive
			},
			counter: 'span.' + options.cssClasses.counter,
			steps: {
				wrapper: tmpStepwrapperDiv,
				all: tmpStepsDiv,
				current: tmpStepsDiv + ':visible'
			},
			buttons: {
				div: 'div.' + options.cssClasses.buttons.div
			}
		};


		w.changeStep = function(nextStep, isInit) {
			if (typeof nextStep === 'number')
			{
				if (nextStep < 0 || nextStep > (w.itemCount - 1))
				{
					alert('Index ' + nextStep + ' Out of Range');
					return false;
				}

				nextStep = w.find(selectors.steps.all + ':eq(' + nextStep + ')');
			}
			else if (typeof nextStep === 'object')
			{
				if ( !nextStep.is(selectors.steps.all) )
				{
					alert('Supplied Element is NOT one of the Wizard Steps');
					return false;
				}
			}

			if (!isInit)	w.currentStep.triggerHandler('onDeactivate');
			w.currentStep.hide();
			if (!options.hideTitle)	w.titleDiv.text(nextStep.attr('title'));

			nextStep.show().triggerHandler('onActivate');

			w.currentStep = w.find(selectors.steps.current);
			w.currentStepIndex = getCurrentStepIndex();

			buttons.update();
			if (options.enableMenu)	menu.update();
			if (options.enableCounter)	counter.update();
		};

		function getCurrentStepIndex() {
			var returnIndex = 0;
			var currentTitle = w.currentStep.attr('title');

			var x = 0;
			w.find(selectors.steps.all).each(function() {
				var thisTitle = $(this).attr('title');

				if (thisTitle === currentTitle)	returnIndex = x;

				x++;
			});

			return returnIndex;
		};

		var menu = {
			build: function() {
				var tmpHtml = '<div class="menuwrapper"><div class="menu"><ol>';
				var x = 0;
				w.find(selectors.steps.all).each(function() {
					tmpHtml += '<li><a step="' + x + '">' + $(this).attr('title') + '</a></li>';
					x++;
				});
				tmpHtml += '</ol></div></div>';

				w.menuDiv = $(tmpHtml);
				w.find(selectors.steps.wrapper).prepend(w.menuDiv).append('<div style="clear: both;"></div>');
				w.menuDiv.css({
					'width': options.menuWidth,
					'margin-right': '-' + options.menuWidth,
					'float': 'left'
				});
				w.find(selectors.steps.all).css('margin-left', options.menuWidth);

				w.find(selectors.menu.active).live('click', function() {
					w.changeStep(parseInt($(this).children('a').attr('step')));
				});
			},

			update: function() {
				var menuItemIndex = 0;
				var menuItemStatus = 'active';

				w.menuDiv.find(selectors.menu.div + ' a').each(function() {
					var menuItem = $(this).parent();
					var menuItemAnchor = $(this);

					if ( menuItemAnchor.text() === w.currentStep.attr('title') )
						menuItemStatus = 'current';
					else if (menuItemStatus === 'current')
						menuItemStatus = 'inactive';

					menuItem.removeClass().addClass(menuItemStatus);

					if (menuItem.hasClass('active'))
						menuItemAnchor.attr('href', 'javascript:void(0);');
					else
						menuItemAnchor.removeAttr('href');

					if (options.enableThemeRoller)
					{
						if (menuItem.hasClass('active'))
							menuItem.addClass('ui-state-default');
						else if (menuItem.hasClass('current'))
							menuItem.addClass('ui-state-highlight');
						else
							menuItem.addClass('ui-state-disabled');
					}

					menuItemIndex++;
				});
			}
		};

		var counter = {
			build: function() {
				w.counterSpan = $('<span class="' + options.cssClasses.counter + '" />');
				w.buttonsDiv.prepend(w.counterSpan);
			},

			update: function() {
				var text = '';

				if (options.counterType === 'percentage')
				{
					var percentage = Math.round((w.currentStepIndex / w.itemCount) * 100);
					text = percentage + '% Complete';
				}
				else
				{
					text = (w.currentStepIndex + 1) + ' of ' + w.itemCount + ' Complete';
				}

				w.counterSpan.text(text);
			}
		};

		var buttons = {
			build: function() {
				w.buttonsDiv = $('<div class="' + options.cssClasses.buttons.div + '"></div>');
				w.cancelButton = $('<button type="button" class="' + options.cssClasses.buttons.cancel + '">' + options.buttonText.cancel + '</button>');
				w.previousButton = $('<button type="button" class="' + options.cssClasses.buttons.previous + '">' + options.buttonText.previous + '</button>');
				w.nextButton = $('<button type="button" class="' + options.cssClasses.buttons.next + '">' + options.buttonText.next + '</button>');
				w.finishButton = $('<button type="' + options.finishButtonType + '" class="' + options.cssClasses.buttons.finish + '">' + options.buttonText.finish + '</button>');

				w.nextButton.click(function() {
					w.changeStep(w.currentStep.next(selectors.steps.all));
				});
				w.previousButton.click(function() {
					w.changeStep(w.currentStep.prev(selectors.steps.all));
				});
				w.cancelButton.click(function() {
					w.trigger('onCancel');
				});
				w.finishButton.click(function() {
					w.trigger('onFinish');
				});

				w.buttonsDiv.append(w.cancelButton).append(w.previousButton).append(w.nextButton).append(w.finishButton);
			},

			update: function() {
				var currentId = w.currentStep.attr('id');
				var firstId = w.firstStep.attr('id');
				var lastId = w.lastStep.attr('id');

				switch (currentId)
				{
					case firstId:
						w.previousButton.hide();
						w.nextButton.show();
						w.finishButton.hide();
						break;

					case lastId:
						w.previousButton.show();
						w.nextButton.hide();
						w.finishButton.show();
						break;

					default:
						w.previousButton.show();
						w.nextButton.show();
						w.finishButton.hide();
						break;
				}
			}
		};

		w.bind('onFinish', options.events.onFinish);
		w.bind('onCancel', options.events.onCancel);

		buttons.build();

		w.children('div').addClass(options.cssClasses.steps.all);	// Add the assigned class to the Step <div>'s
		w.itemCount = w.find(selectors.steps.all).size();
		w.find(selectors.steps.all).hide();
		w.stepWrapperDiv = $('<div class="stepwrapper"></div>');
		w.find(selectors.steps.all).wrapAll(w.stepWrapperDiv);

		w.firstStep = w.find(selectors.steps.all + ':first');
		w.lastStep = w.find(selectors.steps.all + ':last');
		w.currentStep = w.find(selectors.steps.all + ':eq(' + options.startStep + ')');

		if (options.hideCancelButton)	w.cancelButton.hide();
		if (options.hideButtons)
		{		
			w.buttonsDiv.hide();
		}

		if (!options.hideTitle)
		{
			w.titleDiv = $('<div class="' + options.cssClasses.title + '"></div>');
			w.prepend(w.titleDiv);
		}
		w.append(w.buttonsDiv);

		if (options.enableMenu)	menu.build();
		if (options.enableCounter)	counter.build();

		if (options.enableThemeRoller)
		{
			w.addClass('ui-widget');
			w.find(selectors.steps.wrapper).addClass('ui-widget-content');
			w.buttonsDiv.addClass('ui-widget-content');
			w.buttonsDiv.find('button').addClass('ui-state-default');

			if (!options.hideTitle)
				w.titleDiv.addClass('ui-widget-header');

			if (options.enableMenu)
				w.menuDiv.find(selectors.menu.active).addClass('ui-state-default');

			if (options.enableCounter)
				w.counterSpan.addClass('ui-widget-content');

			w.find('.ui-state-default')
				.live('mouseover',	function() { $(this).addClass('ui-state-hover'); } )
				.live('mouseout',		function() { $(this).removeClass('ui-state-hover'); } )
				.live('mousedown',	function() { $(this).addClass('ui-state-active'); } )
				.live('mouseup',		function() { $(this).removeClass('ui-state-active'); } );
		}

		w.changeStep(parseInt(options.startStep), true);

		return w;
	};

	$.fn.jWizard = function(options) {
		return this.each(function() {
			var element = $(this);

			// Return early if this element already has a plugin instance
			if (element.data('jWizard')) return;

			// pass options to plugin constructor
			var w = new jWizard(this, options);

			// Store plugin object in this element's data
			element.data('jWizard', w);
		});
	};
})(jQuery);