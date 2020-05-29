/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
var __values=this&&this.__values||function(e){var t="function"==typeof Symbol&&e[Symbol.iterator],a=0;return t?t.call(e):{next:function(){return e&&a>=e.length&&(e=void 0),{value:e&&e[a++],done:!e}}}};define(["require","exports","./Enum/Severity","jquery","./Icons","TYPO3/CMS/Backend/Wizard"],function(e,t,a,n,o,l){"use strict";return new(function(){function e(){var e=this;this.triggerButton=".t3js-localize",this.localizationMode=null,this.sourceLanguage=null,this.records=[],n(function(){e.initialize()})}return e.prototype.initialize=function(){var e=this,t=this;o.getIcon("actions-localize",o.sizes.large).done(function(i){o.getIcon("actions-edit-copy",o.sizes.large).done(function(c){n(t.triggerButton).removeClass("disabled"),n(document).on("click",t.triggerButton,function(t){t.preventDefault();var r=n(t.currentTarget),d=[],s="";r.data("allowTranslate")&&d.push('<div class="row"><div class="btn-group col-sm-3"><label class="btn btn-block btn-default t3js-localization-option" data-helptext=".t3js-helptext-translate">'+i+'<input type="radio" name="mode" id="mode_translate" value="localize" style="display: none"><br>Translate</label></div><div class="col-sm-9"><p class="t3js-helptext t3js-helptext-translate text-muted">'+TYPO3.lang["localize.educate.translate"]+"</p></div></div>"),r.data("allowCopy")&&d.push('<div class="row"><div class="col-sm-3 btn-group"><label class="btn btn-block btn-default t3js-localization-option" data-helptext=".t3js-helptext-copy">'+c+'<input type="radio" name="mode" id="mode_copy" value="copyFromLanguage" style="display: none"><br>Copy</label></div><div class="col-sm-9"><p class="t3js-helptext t3js-helptext-copy text-muted">'+TYPO3.lang["localize.educate.copy"]+"</p></div></div>"),s+='<div data-toggle="buttons">'+d.join("<hr>")+"</div>",l.addSlide("localize-choose-action",TYPO3.lang["localize.wizard.header_page"].replace("{0}",r.data("page")).replace("{1}",r.data("languageName")),s,a.SeverityEnum.info),l.addSlide("localize-choose-language",TYPO3.lang["localize.view.chooseLanguage"],"",a.SeverityEnum.info,function(t){o.getIcon("spinner-circle-dark",o.sizes.large).done(function(a){t.html('<div class="text-center">'+a+"</div>"),e.loadAvailableLanguages(parseInt(r.data("pageId"),10),parseInt(r.data("languageId"),10)).done(function(a){if(1===a.length)return e.sourceLanguage=a[0].uid,void l.unlockNextStep().trigger("click");l.getComponent().on("click",".t3js-language-option",function(t){var a=n(t.currentTarget).find('input[type="radio"]');e.sourceLanguage=a.val(),console.log("Localization.ts@132",e.sourceLanguage),l.unlockNextStep()});var o,i,c=n("<div />",{class:"row","data-toggle":"buttons"});try{for(var r=__values(a),d=r.next();!d.done;d=r.next()){var s=d.value;c.append(n("<div />",{class:"col-sm-4"}).append(n("<label />",{class:"btn btn-default btn-block t3js-language-option option"}).text(" "+s.title).prepend(s.flagIcon).prepend(n("<input />",{type:"radio",name:"language",id:"language"+s.uid,value:s.uid,style:"display: none;"}))))}}catch(e){o={error:e}}finally{try{d&&!d.done&&(i=r.return)&&i.call(r)}finally{if(o)throw o.error}}t.empty().append(c)})})}),l.addSlide("localize-summary",TYPO3.lang["localize.view.summary"],"",a.SeverityEnum.info,function(t){o.getIcon("spinner-circle-dark",o.sizes.large).done(function(e){t.html('<div class="text-center">'+e+"</div>")}),e.getSummary(parseInt(r.data("pageId"),10),parseInt(r.data("languageId"),10)).done(function(a){t.empty(),e.records=[];var o=a.columns.columns;a.columns.columnList.forEach(function(l){if(void 0!==a.records[l]){var i=o[l],c=n("<div />",{class:"row"});a.records[l].forEach(function(t){var a=" ("+t.uid+") "+t.title;e.records.push(t.uid),c.append(n("<div />",{class:"col-sm-6"}).append(n("<div />",{class:"input-group"}).append(n("<span />",{class:"input-group-addon"}).append(n("<input />",{type:"checkbox",class:"t3js-localization-toggle-record",id:"record-uid-"+t.uid,checked:"checked","data-uid":t.uid,"aria-label":a})),n("<label />",{class:"form-control",for:"record-uid-"+t.uid}).text(a).prepend(t.icon))))}),t.append(n("<fieldset />",{class:"localization-fieldset"}).append(n("<label />").text(i).prepend(n("<input />",{class:"t3js-localization-toggle-column",type:"checkbox",checked:"checked"})),c))}}),l.unlockNextStep(),l.getComponent().on("change",".t3js-localization-toggle-record",function(t){var a=n(t.currentTarget),o=a.data("uid"),i=a.closest("fieldset"),c=i.find(".t3js-localization-toggle-column");if(a.is(":checked"))e.records.push(o);else{var r=e.records.indexOf(o);r>-1&&e.records.splice(r,1)}var d=i.find(".t3js-localization-toggle-record"),s=i.find(".t3js-localization-toggle-record:checked");c.prop("checked",s.length>0),c.prop("indeterminate",s.length>0&&s.length<d.length),e.records.length>0?l.unlockNextStep():l.lockNextStep()}).on("change",".t3js-localization-toggle-column",function(e){var t=n(e.currentTarget),a=t.closest("fieldset").find(".t3js-localization-toggle-record");a.prop("checked",t.is(":checked")),a.trigger("change")})})}),l.addFinalProcessingSlide(function(){e.localizeRecords(parseInt(r.data("pageId"),10),parseInt(r.data("languageId"),10),e.records).done(function(){l.dismiss(),document.location.reload()})}).done(function(){l.show(),l.getComponent().on("click",".t3js-localization-option",function(t){var a=n(t.currentTarget),o=a.find('input[type="radio"]');if(a.data("helptext")){var i=n(t.delegateTarget);i.find(".t3js-helptext").addClass("text-muted"),i.find(a.data("helptext")).removeClass("text-muted")}e.localizationMode=o.val(),l.unlockNextStep()})})})})})},e.prototype.loadAvailableLanguages=function(e,t){return n.ajax({url:TYPO3.settings.ajaxUrls.page_languages,data:{pageId:e,languageId:t}})},e.prototype.getSummary=function(e,t){return n.ajax({url:TYPO3.settings.ajaxUrls.records_localize_summary,data:{pageId:e,destLanguageId:t,languageId:this.sourceLanguage}})},e.prototype.localizeRecords=function(e,t,a){return n.ajax({url:TYPO3.settings.ajaxUrls.records_localize,data:{pageId:e,srcLanguageId:this.sourceLanguage,destLanguageId:t,action:this.localizationMode,uidList:a}})},e}())});