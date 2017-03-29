(function() {
  var template = Handlebars.template, templates = Handlebars.templates = Handlebars.templates || {};
templates['mangacard'] = template({"1":function(container,depth0,helpers,partials,data) {
    var helper, alias1=depth0 != null ? depth0 : {}, alias2=helpers.helperMissing, alias3="function", alias4=container.escapeExpression;

  return "                    <a title=\""
    + alias4(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"name","hash":{},"data":data}) : helper)))
    + "\" href=\"\">"
    + alias4(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"name","hash":{},"data":data}) : helper)))
    + "</a>\r\n";
},"3":function(container,depth0,helpers,partials,data) {
    var helper, alias1=depth0 != null ? depth0 : {}, alias2=helpers.helperMissing, alias3="function", alias4=container.escapeExpression;

  return "                    <a href=\"/the-loai/"
    + alias4(((helper = (helper = helpers.slug || (depth0 != null ? depth0.slug : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"slug","hash":{},"data":data}) : helper)))
    + "\" class=\"deep-orange lighten-3 chip small-tag\">"
    + alias4(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"name","hash":{},"data":data}) : helper)))
    + "</a>\r\n";
},"compiler":[7,">= 4.0.0"],"main":function(container,depth0,helpers,partials,data) {
    var stack1, helper, alias1=depth0 != null ? depth0 : {}, alias2=helpers.helperMissing, alias3="function", alias4=container.escapeExpression, alias5=container.lambda;

  return "<div class=\"col s12 m6 l4 manga-wrapper\">\r\n    <div class=\"card padding-0 short-infomation\">\r\n        <div class=\"row row-poster\">\r\n            <div class=\"col s4 padding-0\">\r\n                <a title=\""
    + alias4(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"name","hash":{},"data":data}) : helper)))
    + "\" class=\"black-text\" href=\"/truyen/"
    + alias4(((helper = (helper = helpers.slug || (depth0 != null ? depth0.slug : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"slug","hash":{},"data":data}) : helper)))
    + "\" rel=\"contents\">\r\n                    <img alt=\"Read latest "
    + alias4(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"name","hash":{},"data":data}) : helper)))
    + " manga online for free\" title=\"Read latest "
    + alias4(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"name","hash":{},"data":data}) : helper)))
    + " manga online for free\" class=\"manga-poster\" src=\""
    + alias4(((helper = (helper = helpers.poster || (depth0 != null ? depth0.poster : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"poster","hash":{},"data":data}) : helper)))
    + "\" />\r\n                </a>\r\n            </div>\r\n            <div class=\"col s8 padding-0 \">\r\n\r\n                <h3 class=\"title-h3 activator grey-text text-darken-4\"><a class=\"black-text\" href=\"/truyen/"
    + alias4(((helper = (helper = helpers.slug || (depth0 != null ? depth0.slug : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"slug","hash":{},"data":data}) : helper)))
    + "\" rel=\"contents\">"
    + alias4(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"name","hash":{},"data":data}) : helper)))
    + "</a><i class=\"material-icons right\">more_vert</i></h3>\r\n\r\n                <a href=\"/truyen/"
    + alias4(((helper = (helper = helpers.slug || (depth0 != null ? depth0.slug : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"slug","hash":{},"data":data}) : helper)))
    + "/"
    + alias4(alias5(((stack1 = (depth0 != null ? depth0.latestChap : depth0)) != null ? stack1.slug : stack1), depth0))
    + "\" class=\"teal-text truncate padding-0 margin-0\">Chapter : "
    + alias4(alias5(((stack1 = (depth0 != null ? depth0.latestChap : depth0)) != null ? stack1.chapter_number : stack1), depth0))
    + "</a>\r\n                <p class=\"truncate padding-0 margin-0\">Tác giả:\r\n"
    + ((stack1 = helpers.each.call(alias1,(depth0 != null ? depth0.authors : depth0),{"name":"each","hash":{},"fn":container.program(1, data, 0),"inverse":container.noop,"data":data})) != null ? stack1 : "")
    + "                </p>\r\n                <p class=\"padding-0 margin-0\">View :"
    + alias4(((helper = (helper = helpers.view || (depth0 != null ? depth0.view : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"view","hash":{},"data":data}) : helper)))
    + "</p>\r\n                <span class=\"badge green white-text past-timer\">"
    + alias4(((helper = (helper = helpers.updated || (depth0 != null ? depth0.updated : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"updated","hash":{},"data":data}) : helper)))
    + "</span>\r\n            </div>\r\n        </div>\r\n        <div class=\"card-reveal\">\r\n            <span class=\"card-title grey-text text-darken-4\"><i class=\"material-icons right\">close</i></span>\r\n            <span class=\"\">\r\n"
    + ((stack1 = helpers.each.call(alias1,(depth0 != null ? depth0.genres : depth0),{"name":"each","hash":{},"fn":container.program(3, data, 0),"inverse":container.noop,"data":data})) != null ? stack1 : "")
    + "                      </span>\r\n            <p>"
    + alias4(((helper = (helper = helpers.description || (depth0 != null ? depth0.description : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"description","hash":{},"data":data}) : helper)))
    + "</p>\r\n            <div class=\"center\">\r\n                <a class=\"teal-text\" href=\"/truyen/"
    + alias4(((helper = (helper = helpers.slug || (depth0 != null ? depth0.slug : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"slug","hash":{},"data":data}) : helper)))
    + "\">Đọc ngay</a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n";
},"useData":true});
})();