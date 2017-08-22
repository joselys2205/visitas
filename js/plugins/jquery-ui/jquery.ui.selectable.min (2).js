/*!
 * jQuery UI Selectable 1.10.0
 * http://jqueryui.com
 *
 * Copyright 2013 jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 *
 * http://api.jqueryui.com/selectable/
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.mouse.js
 *	jquery.ui.widget.js
 */(function(e,t){e.widget("ui.selectable",e.ui.mouse,{version:"1.10.0",options:{appendTo:"body",autoRefresh:!0,distance:0,filter:"*",tolerance:"touch",selected:null,selecting:null,start:null,stop:null,unselected:null,unselecting:null},_create:function(){var t,n=this;this.element.addClass("ui-selectable");this.dragged=!1;this.refresh=function(){t=e(n.options.filter,n.element[0]);t.addClass("ui-selectee");t.each(function(){var t=e(this),n=t.offset();e.data(this,"selectable-item",{element:this,$element:t,left:n.left,top:n.top,right:n.left+t.outerWidth(),bottom:n.top+t.outerHeight(),startselected:!1,selected:t.hasClass("ui-selected"),selecting:t.hasClass("ui-selecting"),unselecting:t.hasClass("ui-unselecting")})})};this.refresh();this.selectees=t.addClass("ui-selectee");this._mouseInit();this.helper=e("<div class='ui-selectable-helper'></div>")},_destroy:function(){this.selectees.removeClass("ui-selectee").removeData("selectable-item");this.element.removeClass("ui-selectable ui-selectable-disabled");this._mouseDestroy()},_mouseStart:function(t){var n=this,r=this.options;this.opos=[t.pageX,t.pageY];if(this.options.disabled)return;this.selectees=e(r.filter,this.element[0]);this._trigger("start",t);e(r.appendTo).append(this.helper);this.helper.css({left:t.pageX,top:t.pageY,width:0,height:0});r.autoRefresh&&this.refresh();this.selectees.filter(".ui-selected").each(function(){var r=e.data(this,"selectable-item");r.startselected=!0;if(!t.metaKey&&!t.ctrlKey){r.$element.removeClass("ui-selected");r.selected=!1;r.$element.addClass("ui-unselecting");r.unselecting=!0;n._trigger("unselecting",t,{unselecting:r.element})}});e(t.target).parents().addBack().each(function(){var r,i=e.data(this,"selectable-item");if(i){r=!t.metaKey&&!t.ctrlKey||!i.$element.hasClass("ui-selected");i.$element.removeClass(r?"ui-unselecting":"ui-selected").addClass(r?"ui-selecting":"ui-unselecting");i.unselecting=!r;i.selecting=r;i.selected=r;r?n._trigger("selecting",t,{selecting:i.element}):n._trigger("unselecting",t,{unselecting:i.element});return!1}})},_mouseDrag:function(t){this.dragged=!0;if(this.options.disabled)return;var n,r=this,i=this.options,s=this.opos[0],o=this.opos[1],u=t.pageX,a=t.pageY;if(s>u){n=u;u=s;s=n}if(o>a){n=a;a=o;o=n}this.helper.css({left:s,top:o,width:u-s,height:a-o});this.selectees.each(function(){var n=e.data(this,"selectable-item"),f=!1;if(!n||n.element===r.element[0])return;i.tolerance==="touch"?f=!(n.left>u||n.right<s||n.top>a||n.bottom<o):i.tolerance==="fit"&&(f=n.left>s&&n.right<u&&n.top>o&&n.bottom<a);if(f){if(n.selected){n.$element.removeClass("ui-selected");n.selected=!1}if(n.unselecting){n.$element.removeClass("ui-unselecting");n.unselecting=!1}if(!n.selecting){n.$element.addClass("ui-selecting");n.selecting=!0;r._trigger("selecting",t,{selecting:n.element})}}else{if(n.selecting)if((t.metaKey||t.ctrlKey)&&n.startselected){n.$element.removeClass("ui-selecting");n.selecting=!1;n.$element.addClass("ui-selected");n.selected=!0}else{n.$element.removeClass("ui-selecting");n.selecting=!1;if(n.startselected){n.$element.addClass("ui-unselecting");n.unselecting=!0}r._trigger("unselecting",t,{unselecting:n.element})}if(n.selected&&!t.metaKey&&!t.ctrlKey&&!n.startselected){n.$element.removeClass("ui-selected");n.selected=!1;n.$element.addClass("ui-unselecting");n.unselecting=!0;r._trigger("unselecting",t,{unselecting:n.element})}}});return!1},_mouseStop:function(t){var n=this;this.dragged=!1;e(".ui-unselecting",this.element[0]).each(function(){var r=e.data(this,"selectable-item");r.$element.removeClass("ui-unselecting");r.unselecting=!1;r.startselected=!1;n._trigger("unselected",t,{unselected:r.element})});e(".ui-selecting",this.element[0]).each(function(){var r=e.data(this,"selectable-item");r.$element.removeClass("ui-selecting").addClass("ui-selected");r.selecting=!1;r.selected=!0;r.startselected=!0;n._trigger("selected",t,{selected:r.element})});this._trigger("stop",t);this.helper.remove();return!1}})})(jQuery);