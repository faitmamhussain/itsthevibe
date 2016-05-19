// START pubfood
/*! pubfood v0.2.0 | (c) pubfood | http://pubfood.org/LICENSE.txt */
!function(t){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=t();else if("function"==typeof define&&define.amd)define([],t);else{var e;e="undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this,e.pubfood=t()}}(function(){return function t(e,i,r){function n(s,a){if(!i[s]){if(!e[s]){var u="function"==typeof require&&require;if(!a&&u)return u(s,!0);if(o)return o(s,!0);var p=new Error("Cannot find module '"+s+"'");throw p.code="MODULE_NOT_FOUND",p}var d=i[s]={exports:{}};e[s][0].call(d.exports,function(t){var i=e[s][1][t];return n(i?i:t)},d,d.exports,t,e,i,r)}return i[s].exports}for(var o="function"==typeof require&&require,s=0;s<r.length;s++)n(r[s]);return n}({1:[function(t,e,i){"use strict";function r(t,e,i){this.fn=t,this.context=e,this.once=i||!1}function n(){}var o="function"!=typeof Object.create?"~":!1;n.prototype._events=void 0,n.prototype.listeners=function(t,e){var i=o?o+t:t,r=this._events&&this._events[i];if(e)return!!r;if(!r)return[];if(r.fn)return[r.fn];for(var n=0,s=r.length,a=new Array(s);s>n;n++)a[n]=r[n].fn;return a},n.prototype.emit=function(t,e,i,r,n,s){var a=o?o+t:t;if(!this._events||!this._events[a])return!1;var u,p,d=this._events[a],h=arguments.length;if("function"==typeof d.fn){switch(d.once&&this.removeListener(t,d.fn,void 0,!0),h){case 1:return d.fn.call(d.context),!0;case 2:return d.fn.call(d.context,e),!0;case 3:return d.fn.call(d.context,e,i),!0;case 4:return d.fn.call(d.context,e,i,r),!0;case 5:return d.fn.call(d.context,e,i,r,n),!0;case 6:return d.fn.call(d.context,e,i,r,n,s),!0}for(p=1,u=new Array(h-1);h>p;p++)u[p-1]=arguments[p];d.fn.apply(d.context,u)}else{var l,c=d.length;for(p=0;c>p;p++)switch(d[p].once&&this.removeListener(t,d[p].fn,void 0,!0),h){case 1:d[p].fn.call(d[p].context);break;case 2:d[p].fn.call(d[p].context,e);break;case 3:d[p].fn.call(d[p].context,e,i);break;default:if(!u)for(l=1,u=new Array(h-1);h>l;l++)u[l-1]=arguments[l];d[p].fn.apply(d[p].context,u)}}return!0},n.prototype.on=function(t,e,i){var n=new r(e,i||this),s=o?o+t:t;return this._events||(this._events=o?{}:Object.create(null)),this._events[s]?this._events[s].fn?this._events[s]=[this._events[s],n]:this._events[s].push(n):this._events[s]=n,this},n.prototype.once=function(t,e,i){var n=new r(e,i||this,!0),s=o?o+t:t;return this._events||(this._events=o?{}:Object.create(null)),this._events[s]?this._events[s].fn?this._events[s]=[this._events[s],n]:this._events[s].push(n):this._events[s]=n,this},n.prototype.removeListener=function(t,e,i,r){var n=o?o+t:t;if(!this._events||!this._events[n])return this;var s=this._events[n],a=[];if(e)if(s.fn)(s.fn!==e||r&&!s.once||i&&s.context!==i)&&a.push(s);else for(var u=0,p=s.length;p>u;u++)(s[u].fn!==e||r&&!s[u].once||i&&s[u].context!==i)&&a.push(s[u]);return a.length?this._events[n]=1===a.length?a[0]:a:delete this._events[n],this},n.prototype.removeAllListeners=function(t){return this._events?(t?delete this._events[o?o+t:t]:this._events=o?{}:Object.create(null),this):this},n.prototype.off=n.prototype.removeListener,n.prototype.addListener=n.prototype.on,n.prototype.setMaxListeners=function(){return this},n.prefixed=o,"undefined"!=typeof e&&(e.exports=n)},{}],2:[function(t,e,i){"use strict";function r(){this.operators=[]}r.prototype.addOperator=function(t){this.operators.push(t)},r.prototype.process=function(t,e){for(var i=t,r=0;r<this.operators.length;r++)i=this.operators[r].process(i,e);return i},e.exports=r},{}],3:[function(t,e,i){"use strict";function r(){this.operators=[]}r.prototype.addOperator=function(t){this.operators.push(t)},r.prototype.process=function(t,e){for(var i=t,r=0;r<this.operators.length;r++)i=this.operators[r].process(i,e);return i},e.exports=r},{}],4:[function(t,e,i){"use strict";function r(t){this.name="OP-"+n.newId(),this.transform=t}var n=t("../util"),o=t("../event"),s=t("../errors");r.validate=function(t){return!!t&&"function"===n.asType(t)},r.withDelegate=function(t){if(!r.validate(t))return null;var e=new r(t);return e},r.prototype.setName=function(t){return this.name=t,this},r.prototype.process=function(t,e){if(!t)return null;var i=this.transform(t,e);return i||o.publish(o.EVENT_TYPE.ERROR,new s("no transform output")),i||null},e.exports=r},{"../errors":5,"../event":6,"../util":16}],5:[function(t,e,i){"use strict";function r(t){this.name=n,this.message=t||"Pubfood integration error.",this.stack=(new Error).stack}var n="PubfoodError";r.prototype=Object.create(Error.prototype),r.prototype.constructor=r,r.prototype.name=n,r.prototype.is=function(t){return t&&t.name===n},e.exports=r},{}],6:[function(t,e,i){"use strict";function r(){this.auctionId="pubfood:"+Date.now(),this.observeImmediate_={}}var n=t("./util"),o=t("./logger"),s=t("eventemitter3");r.prototype.setAuctionId=function(t){var e=n.asType(t);return("string"===e||"number"===e)&&(this.auctionId=t),this.auctionId},r.prototype.EVENT_TYPE={PUBFOOD_API_LOAD:"PUBFOOD_API_LOAD",PUBFOOD_API_START:"PUBFOOD_API_START",PUBFOOD_API_REFRESH:"PUBFOOD_API_REFRESH",BID_LIB_START:"BID_LIB_START",BID_LIB_LOAD:"BID_LIB_LOAD",BID_LIB_LOADED:"BID_LIB_LOADED",BID_START:"BID_START",BID_PUSH_NEXT:"BID_PUSH_NEXT",BID_PUSH_NEXT_LATE:"BID_PUSH_NEXT_LATE",BID_COMPLETE:"BID_COMPLETE",BID_ASSEMBLER:"BID_ASSEMBLER",AUCTION_LIB_START:"AUCTION_LIB_START",AUCTION_LIB_LOAD:"AUCTION_LIB_LOAD",AUCTION_LIB_LOADED:"AUCTION_LIB_LOADED",AUCTION_GO:"AUCTION_GO",AUCTION_START:"AUCTION_START",AUCTION_TRIGGER:"AUCTION_TRIGGER",AUCTION_REFRESH:"AUCTION_REFRESH",AUCTION_COMPLETE:"AUCTION_COMPLETE",AUCTION_POST_RUN:"AUCTION_POST_RUN",ERROR:"ERROR",WARN:"WARN",INVALID:"INVALID"},r.prototype.publish=function(t,e,i){var r=+new Date;t===this.EVENT_TYPE.PUBFOOD_API_START&&e&&(r=e);var n={auctionId:this.auctionId,ts:r,type:t,eventContext:i||"pubfood",data:e||""};return o.logEvent(t,this.auctionId,n),this.emit(t,n)},n["extends"](r,s),r.prototype.emit=function(t){var e=s.prototype.emit.apply(this,arguments);return e&&this.EVENT_TYPE.AUCTION_POST_RUN!==t||(e=!0,this.observeImmediate_[t]=this.observeImmediate_[t]||[],this.observeImmediate_[t].push(Array.prototype.slice.call(arguments,1))),e},r.prototype.on=function(t,e){var i=this.observeImmediate_[t]||null;if(i){for(var r=0;r<i.length;r++)e.apply(this,i[r]);return this}return s.prototype.on.apply(this,arguments)},r.prototype.removeAllListeners=function(){return s.prototype.removeAllListeners.call(this),this.observeImmediate_={},this},e.exports=new r},{"./logger":8,"./util":16,eventemitter3:1}],7:[function(t,e,i){"use strict";var r={name:"",libUri:"",timeout:0,init:function(t,e){},refresh:function(t,e){}};r.optional={refresh:!0,timeout:!0};var n={name:"__default__",libUri:" ",timeout:0,init:function(t,e,i){i()},refresh:function(t,e,i){i()}};n.optional={libUri:!0,refresh:!0,timeout:!0};var o=function(t,e){},s={slot:"",value:"",sizes:[],targeting:{},label:""},a={name:"",elementId:"",sizes:[],bidProviders:[]};e.exports={BidDelegate:n,AuctionDelegate:r,SlotConfig:a,BidObject:s,TransformDelegate:o}},{}],8:[function(t,e,i){"use strict";var r={history:[],dumpLog:function(t){if(console&&console.log){var e;t&&(e=new RegExp(t,"g"));for(var i=0;i<this.history.length;i++){var r=this.history[i];e?(e.lastIndex=0,r.eventName&&e.test(r.eventName)&&console.log(r),r.functionName&&e.test(r.functionName)&&console.log(r)):console.log(r)}}},logCall:function(t,e,i){this.history.push({ts:+new Date,auctionId:e,functionName:t,args:Array.prototype.slice.call(i)})},logEvent:function(t,e,i){this.history.push({ts:+new Date,auctionId:e,eventName:t,event:i})}};e.exports=r},{}],9:[function(t,e,i){"use strict";function r(t){this.init_&&this.init_(),this.prefix=t&&t.hasOwnProperty("prefix")?t.prefix:!0,this.slotMap={},this.bidProviders={},this.auctionProvider=null,this.auctionRun={},this.timeout_=r.NO_TIMEOUT,this.trigger_=null,this.bidAssembler=new a,this.requestAssembler=new u,this.auctionIdx_=0,this.doneCallbackOffset_=r.DEFAULT_DONE_CALLBACK_OFFSET,this.omitDefaultBidKey_=!1,l.setAuctionId(this.getAuctionId())}var n=t("../util"),o=t("../model/slot"),s=t("../model/bid"),a=t("../assembler/bidassembler"),u=t("../assembler/requestassembler"),p=t("../assembler/transformoperator"),d=t("../provider/auctionprovider"),h=t("../provider/bidprovider"),l=t("../event"),c=t("../pubfoodobject");r.PAGE_BIDS="page",r.AUCTION_TYPE={START:"init",REFRESH:"refresh"},r.IN_AUCTION={FALSE:!1,PENDING:"pending",DONE:"done"},r.NO_TIMEOUT=-1,r.DEFAULT_DONE_CALLBACK_OFFSET=5e3,r.prototype.validate=function(t){var e=!0,i={hasAuctionProvider:function(){return!!this.auctionProvider},hasBidProviders:function(){var t=!1;for(var e in this.bidProviders){t=!0;break}return t||l.publish(l.EVENT_TYPE.WARN,{msg:"Warn: no bid providers"}),t},hasSlots:function(){for(var t in this.slotMap)return!0;return!1},hasAllSlotsBidder:function(){var t=[];for(var e in this.slotMap){var i=this.slotMap[e];i.bidProviders&&i.bidProviders[0]||t.push(i.name)}return t.length>0&&l.publish(l.EVENT_TYPE.WARN,{msg:"Warn: no bidders - "+t.join(", ")}),0===t.length}};i.hasBidProviders.warn=!0;for(var r in i)if(e=i[r].call(this),e=i[r].warn?!0:e,!e){l.publish(l.EVENT_TYPE.INVALID,{msg:"Failed: "+r});break}return e},r.prototype.newAuctionRun=function(t){var e=++this.auctionIdx_,i=[];if(n.isArray(t)&&t.length>0)for(var o=0;o<t.length;o++){var s=t[o];this.slotMap[s]?i.push(this.slotMap[s]):l.publish(l.EVENT_TYPE.WARN,"Can't refresh slot \""+s+"\", because it wasn't defined")}else for(var a in this.slotMap)i.push(this.slotMap[a]);var u={inAuction:r.IN_AUCTION.FALSE,slots:i,bids:[],lateBids:[],bidStatus:{},targeting:[]};for(var a in this.bidProviders){var p=this.bidProviders[a];!p||p.name in u.bidStatus||!p.enabled()||(u.bidStatus[p.name]=!1)}return this.auctionRun[e]=u,e},r.prototype.getBidStatus=function(t,e){var i=[];if(e){var r=this.auctionRun[e],o=r?r.bidStatus[t]:"";i="boolean"===n.asType(o)?o:-1}else for(var s in this.auctionRun){var o=this.auctionRun[s].bidStatus[t];i.push("boolean"===n.asType(o)?o:-1)}return i},r.prototype.timeout=function(t){this.timeout_="number"===n.asType(t)&&t>0?t:r.NO_TIMEOUT},r.prototype.getTimeout=function(){return this.timeout_},r.prototype.doneCallbackOffset=function(t){this.doneCallbackOffset_="number"===n.asType(t)?t:r.DEFAULT_DONE_CALLBACK_OFFSET},r.prototype.getDoneCallbackOffset=function(){return this.doneCallbackOffset_},r.prototype.setAuctionProviderCbTimeout=function(t){this.initDoneTimeout_="number"===n.asType(t)&&t>0?t:this.doneCallbackOffset_},r.prototype.setAuctionTrigger=function(t){this.trigger_=t},r.prototype.startAuction_=function(t,e){l.publish(l.EVENT_TYPE.BID_ASSEMBLER,"AuctionMediator"),this.bidAssembler.operators.length>0&&this.bidAssembler.process(this.auctionRun[t].bids),this.processTargeting_(t,e)},r.prototype.startTimeout_=function(t,e){if(this.timeout_!==r.NO_TIMEOUT&&this.timeout_>=0){var i=t,o=e,s=n.bind(this.startAuction_,this);setTimeout(function(){s(i,o)},this.timeout_)}return this},r.prototype.initAuctionTrigger_=function(t,e){function i(){this.auctionRun[r].inAuction||this.startAuction_(r,o)}if("function"!==n.asType(this.trigger_))return void this.startTimeout_(t,e);var r=t,o=e;return this.trigger_.apply(null,[n.bind(i,this)]),this},r.prototype.allBiddersDone=function(t){var e=!0,i=this.auctionRun[t].bidStatus;for(var r in i)if(!i[r]){e=!1;break}return e},r.prototype.checkBids_=function(t,e){this.allBiddersDone(t)&&!this.auctionRun[t].inAuction&&this.startAuction_(t,e)},r.prototype.getBidKey=function(t){return(this.prefix&&t.provider?t.provider+"_":"")+(t.label||"bid")},r.prototype.mergeKeys=function(t,e){t=n.mergeToObject(t,e)},r.prototype.getBidMap_=function(t){var e={};e[r.PAGE_BIDS]=[];for(var i=this.getAuctionRunBids(t),n=0;n<i.length;n++){var o=i[n];o.slot?(e[o.slot]=e[o.slot]||[],e[o.slot].push(o)):e[r.PAGE_BIDS].push(o)}return e},r.prototype.buildTargeting_=function(t){for(var e,i=[],n=this.getBidMap_(t),o=this.getAuctionRunSlots(t),s=0;s<o.length;s++){var a={bids:[],targeting:{}},u=o[s];a.name=u.name,a.id=u.id,a.elementId=u.elementId||"",a.sizes=u.sizes,a.type="slot",e=n[u.name]||[];for(var p=0;p<e.length;p++){var d=e[p];if(a.bids.push({value:d.value||"",provider:d.provider,id:d.id,targeting:d.targeting||{}}),!this.omitDefaultBidKey()){var h=this.getBidKey(d);a.targeting[h]=a.targeting[h]||d.value||""}this.mergeKeys(a.targeting,d.targeting)}i.push(a)}var l={bids:[],targeting:{}};e=n[r.PAGE_BIDS]||[];for(var c=0;c<e.length;c++){var d=e[c];if(l.bids.push({value:d.value||"",provider:d.provider,id:d.id,targeting:d.targeting}),!this.omitDefaultBidKey()){var h=this.getBidKey(d);l.targeting[h]=l.targeting[h]||d.value||""}this.mergeKeys(l.targeting,d.targeting)}return l.bids.length>0&&(l.type="page",i.push(l)),i},r.prototype.processTargeting_=function(t,e){if(!this.auctionRun[t].inAuction){this.auctionRun[t].inAuction=r.IN_AUCTION.PENDING;var i,n=this,o=!1,s=n.auctionProvider.name,a=t,u=n.auctionProvider.getTimeout(),p=function(){o||(o=!0,clearTimeout(i),n.auctionDone(a,s))};i=setTimeout(function(){o||(l.publish(l.EVENT_TYPE.WARN,'Warning: The auction done callback for "'+s+"\" hasn't been called within the allotted time ("+u/1e3+"sec)"),p())},u),e===r.AUCTION_TYPE.START?(l.publish(l.EVENT_TYPE.AUCTION_GO,s),l.publish(l.EVENT_TYPE.AUCTION_START,s)):l.publish(l.EVENT_TYPE.AUCTION_REFRESH,s);var d=n.buildTargeting_(a);this.auctionRun[a].targeting=d,e===r.AUCTION_TYPE.START?n.auctionProvider.init(d,p):n.auctionProvider.refresh(d,p)}},r.prototype.auctionDone=function(t,e){this.auctionRun[t].inAuction=r.IN_AUCTION.DONE;var i=this.getAuctionRun(t).targeting;l.publish(l.EVENT_TYPE.AUCTION_COMPLETE,{name:e,targeting:i}),setTimeout(function(){l.publish(l.EVENT_TYPE.AUCTION_POST_RUN,e)},0)},r.prototype.addSlot=function(t){var e=o.fromObject(t);return e?this.slotMap[e.name]=e:l.publish(l.EVENT_TYPE.WARN,"Invalid slot object: "+JSON.stringify(t||{})),e},r.prototype.getProviderDoneTimeout_=function(t){var e=this.timeout_+this.doneCallbackOffset_;return t.timeout&&(e=t.timeout),e},r.prototype.getBidProviderDoneTimeout_=function(t){var e=this.getProviderDoneTimeout_(t);return this.callbackTimeout_&&(e=this.callbackTimeout_),e},r.prototype.getAuctionProviderDoneTimeout_=function(t){var e=this.getProviderDoneTimeout_(t);return this.initDoneTimeout_&&(e=this.initDoneTimeout_),e},r.prototype.addBidProvider=function(t){var e=h.withDelegate(t);if(e)if(this.bidProviders[e.name])l.publish(l.EVENT_TYPE.WARN,"Warning: bid provider "+e.name+" is already added");else{var i=this.getBidProviderDoneTimeout_(t);e.timeout(i),this.bidProviders[e.name]=e}else{var r=t&&t.name?t.name:"undefined";l.publish(l.EVENT_TYPE.WARN,"Warning: invalid bid provider: "+r)}return e},r.prototype.bidProviderExists_=function(t){return!!this.bidProviders[t]},r.prototype.setAuctionProvider=function(t){this.auctionProvider&&l.publish(l.EVENT_TYPE.WARN,"Warning: auction provider exists: "+this.auctionProvider.name);var e=d.withDelegate(t);if(e){var i=this.getAuctionProviderDoneTimeout_(t);e.timeout(i),this.auctionProvider=e}else{var r=t&&t.name?t.name:"undefined";l.publish(l.EVENT_TYPE.WARN,"Warning: invalid auction provider: "+r)}return e},r.prototype.addRequestTransform=function(t){return this.requestAssembler.addOperator(new p(t)),this},r.prototype.addBidTransform=function(t){return this.bidAssembler.addOperator(new p(t)),this},r.prototype.loadProviders=function(t){var e,i=[];for(var r in this.bidProviders)i.push(r);t&&n.randomize(i);for(var o=0;o<i.length;o++){var s=i[o];if(this.bidProviders[s].libUri){l.publish(l.EVENT_TYPE.BID_LIB_LOAD,this.bidProviders[s].name),e=this.bidProviders[s].libUri()||"";var a=this.bidProviders[s].sync();n.loadUri(e,a)}}this.auctionProvider&&this.auctionProvider.libUri()&&(l.publish(l.EVENT_TYPE.AUCTION_LIB_LOAD,this.auctionProvider.name),e=this.auctionProvider.libUri(),n.loadUri(e))},r.prototype.getBidderSlots=function(t){var e,i,r={},n=[];for(e=0;e<t.length;e++){var o=t[e];for(i=0;i<o.bidProviders.length;i++){var s=o.bidProviders[i];r[s]=r[s]||[],r[s].push(o)}}for(i in this.bidProviders){var s=this.bidProviders[i];s&&s.enabled()&&n.push({provider:s,slots:r[i]||[]})}return n},r.prototype.start=function(t,e){if(!this.auctionProvider)return l.publish(l.EVENT_TYPE.WARN,"Warning: auction provider is not defined."),this;var i=this.newAuctionRun();l.setAuctionId(this.getAuctionId(i)),l.publish(l.EVENT_TYPE.PUBFOOD_API_START,e),this.initAuctionTrigger_(i,r.AUCTION_TYPE.START),this.loadProviders(t);var n=this.getAuctionRunSlots(i),o=this.getBidderSlots(n);return this.processBids(i,r.AUCTION_TYPE.START,o),this},r.prototype.refresh=function(t){;if(!this.auctionProvider)return l.publish(l.EVENT_TYPE.WARN,"Warning: auction provider is not defined."),this;var e=this.newAuctionRun(t);l.setAuctionId(this.getAuctionId(e)),l.publish(l.EVENT_TYPE.PUBFOOD_API_REFRESH),this.initAuctionTrigger_(e,r.AUCTION_TYPE.REFRESH);var i=this.getAuctionRunSlots(e),n=this.getBidderSlots(i);return this.processBids(e,r.AUCTION_TYPE.REFRESH,n),this},r.prototype.processBids=function(t,e,i){for(var r=0;r<i.length;r++)this.getBids_(t,e,i[r].provider,i[r].slots)},r.prototype.setBidProviderCbTimeout=function(t){this.callbackTimeout_="number"===n.asType(t)&&t>0?t:this.doneCallbackOffset_},r.prototype.getBids_=function(t,e,i,n){var o,s=this,a=i.name,u=!1,p=t,d=i.getTimeout(),h=function(t){t.auctionIdx=p,s.pushBid(p,t,a)},c=function(){u||(u=!0,clearTimeout(o),s.doneBid(p,e,a))};o=setTimeout(function(){u||(l.publish(l.EVENT_TYPE.WARN,'Warning: The bid done callback for "'+a+"\" hasn't been called within the allotted time ("+d/1e3+"sec)"),c())},d),l.publish(l.EVENT_TYPE.BID_START,a),e===r.AUCTION_TYPE.START?i.init(n,h,c):i.refresh(n,h,c)},r.prototype.pushBid=function(t,e,i){var r=s.fromObject(e);r?(r.provider=i,this.auctionRun[t].inAuction?(this.auctionRun[t].lateBids.push(r),l.publish(l.EVENT_TYPE.BID_PUSH_NEXT_LATE,r)):(this.auctionRun[t].bids.push(r),l.publish(l.EVENT_TYPE.BID_PUSH_NEXT,r))):l.publish(l.EVENT_TYPE.WARN,"Invalid bid object: "+JSON.stringify(e||{}))},r.prototype.doneBid=function(t,e,i){l.publish(l.EVENT_TYPE.BID_COMPLETE,i),this.auctionRun[t].bidStatus[i]=!0,this.checkBids_(t,e)},r.prototype.getAuctionCount=function(){return this.auctionIdx_},r.prototype.getAuctionId=function(t){var e=t||this.auctionIdx_;return this.id+":"+e},r.prototype.getAuctionRun=function(t){var e=this.auctionRun[t];return"undefined"===n.asType(e)?{}:e},r.prototype.getAuctionRunSlots=function(t){var e=this.auctionRun[t];return"undefined"===n.asType(e)?{}:e.slots},r.prototype.getAuctionRunBids=function(t){var e=this.auctionRun[t];return"undefined"===n.asType(e)?[]:e.bids},r.prototype.getAuctionRunLateBids=function(t){var e=this.auctionRun[t];return"undefined"===n.asType(e)?[]:e.lateBids},r.prototype.getAuctionRunTargeting=function(t){var e=this.auctionRun[t];return"undefined"===n.asType(e)?[]:e.targeting},r.prototype.prefixDefaultBidKey=function(t){return"boolean"===n.asType(t)&&(this.prefix=t),this.prefix},r.prototype.omitDefaultBidKey=function(t){return"boolean"===n.asType(t)&&(this.omitDefaultBidKey_=t),this.omitDefaultBidKey_},n["extends"](r,c),e.exports=r},{"../assembler/bidassembler":2,"../assembler/requestassembler":3,"../assembler/transformoperator":4,"../event":6,"../model/bid":10,"../model/slot":11,"../provider/auctionprovider":12,"../provider/bidprovider":13,"../pubfoodobject":15,"../util":16}],10:[function(t,e,i){"use strict";function r(t){this.init_&&this.init_(),this.sizes=[],this.slot,this.value=t||0,this.type=n.asType(this.value),this.label,this.provider,this.targeting={}}var n=t("../util"),o=t("../pubfoodobject");r.fromObject=function(t){var e=new r,i=n.clone(t);for(var o in i)e[o]=i[o];var s=n.asType(e.value);return e.type="undefined"!==s?s:"",e},r.prototype.setValue=function(t){return this.value=t||"",this.type=n.asType(this.value),this},r.prototype.addSize=function(t,e){var i=Math.abs(~~t),r=Math.abs(~~e);return this.sizes.push([i,r]),this},n["extends"](r,o),e.exports=r},{"../pubfoodobject":15,"../util":16}],11:[function(t,e,i){"use strict";function r(t,e){this.init_&&this.init_(),this.name=t,this.elementId=e,this.bidProviders=[],this.sizes=[]}var n=t("../util"),o=t("../pubfoodobject"),s=t("../interfaces").SlotConfig;r.validate=function(t){return t?n.validate(s,t):!1},r.fromObject=function(t){if(!r.validate(t))return null;var e=new r;for(var i in t)e[i]=t[i];return e},r.prototype.addSizes=function(t){return Array.prototype.push.apply(this.sizes,t),this},r.prototype.addSize=function(t,e){var i=Math.abs(~~t),r=Math.abs(~~e);return this.sizes.push([i,r]),this},r.prototype.addBidProvider=function(t){return this.bidProviders.push(t),this},n["extends"](r,o),e.exports=r},{"../interfaces":7,"../pubfoodobject":15,"../util":16}],12:[function(t,e,i){"use strict";function r(t){this.init_&&this.init_();var e=t||{};this.name=e.name||"",this.auctionDelegate=e,this.timeout_=e&&e.timeout?e.timeout:0}var n=t("../util"),o=t("../interfaces").AuctionDelegate,s=t("../event"),a=t("../pubfoodobject");r.withDelegate=function(t){if(!r.validate(t))return s.publish(s.EVENT_TYPE.INVALID,{msg:"Warn: invalid auction delegate - "+(t&&JSON.stringify(t))||""}),null;var e=new r(t);return e},r.validate=function(t){return n.validate(o,t)},r.prototype.libUri=function(){return this.auctionDelegate.libUri},r.prototype.init=function(t,e){this.auctionDelegate.init(t,e)},r.prototype.refresh=function(t,e){var i=this.auctionDelegate&&this.auctionDelegate.refresh||null;return i?void i(t,e):void s.publish(s.EVENT_TYPE.WARN,"AuctionProvider.auctionDelegate.refresh not defined.")},r.prototype.timeout=function(t){this.timeout_="number"===n.asType(t)?t:0},r.prototype.getTimeout=function(){return this.timeout_},n["extends"](r,a),e.exports=r},{"../event":6,"../interfaces":7,"../pubfoodobject":15,"../util":16}],13:[function(t,e,i){"use strict";function r(t){this.init_&&this.init_();var e=t||{};this.name=e.name||"",this.bidDelegate=e,this.enabled_=!0,this.timeout_=e&&e.timeout?e.timeout:0}var n=t("../util"),o=t("../interfaces").BidDelegate,s=t("../event"),a=t("../pubfoodobject");r.withDelegate=function(t){if(!r.validate(t))return s.publish(s.EVENT_TYPE.WARN,{msg:"Warn: invalid bidder delegate - "+t||""}),null;var e=new r(t);return e},r.validate=function(t){return n.validate(o,t)},r.prototype.libUri=function(t){return t&&(this.bidDelegate.libUri=t),this.bidDelegate.libUri},r.prototype.sync=function(){var t=Array.prototype.slice.call(arguments);return t.length>0&&"boolean"===n.asType(t[0])&&(this.bidDelegate.sync=t[0]),!!this.bidDelegate.sync},r.prototype.init=function(t,e,i){this.bidDelegate.init(t,e,i)},r.prototype.refresh=function(t,e,i){var r=this.bidDelegate&&this.bidDelegate.refresh||null;return r?void r(t,e,i):void s.publish(s.EVENT_TYPE.WARN,"BidProvider.bidDelegate.refresh not defined.")},r.prototype.enabled=function(t){return"boolean"===n.asType(t)&&(this.enabled_=t),this.enabled_},r.prototype.timeout=function(t){this.timeout_="number"===n.asType(t)?t:0},r.prototype.getTimeout=function(){return this.timeout_},n["extends"](r,a),e.exports=r},{"../event":6,"../interfaces":7,"../pubfoodobject":15,"../util":16}],14:[function(t,e,i){"use strict";var r=t("./event"),n=t("./util"),o=t("./logger"),s=t("./interfaces").BidDelegate,a=t("./mediator/auctionmediator");!function(t,i,r){t&&(e.exports=r(t,t.pfConfig||{}))}(window||{},void 0,function(e){if(e.pubfood)return e.pubfood.library.logger.logEvent(r.EVENT_TYPE.WARN,["multiple api load"]),e.pubfood;var i=function(t){return new i.library.init(t)};i.library=i.prototype={version:"0.2.0",PubfoodError:t("./errors"),logger:o};var u=function(t){var e=t.getBidProviders();for(var i in t.requiredApiCalls)0===t.requiredApiCalls[i]&&t.configErrors.push('"'+i+'" was not called');for(var r=t.getSlots(),n=0;n<r.length;n++)for(var o=0;o<r[n].bidProviders.length;o++){var s=r[n].bidProviders[o];e[s]||t.configErrors.push('No configuration found for bid provider "'+s+'"')}return{hasError:t.configErrors.length>0,details:t.configErrors}},p=i.library.init=function(t){return this.mediator=new a,t&&(this.randomizeBidRequests_=!!t.randomizeBidRequests,this.mediator.setBidProviderCbTimeout(t.bidProviderCbTimeout),this.mediator.setAuctionProviderCbTimeout(t.auctionProviderCbTimeout)),r.publish(r.EVENT_TYPE.PUBFOOD_API_LOAD),this.pushApiCall_("api.init",arguments),this.configErrors=[],this.requiredApiCalls={setAuctionProvider:0,addBidProvider:0},this.util=n,this};return p.prototype.pushApiCall_=function(t,e){this.library.logger.logCall(t,this.getAuctionId(),e)},p.prototype.getAuctionId=function(){return this.mediator.getAuctionId()},p.prototype.dumpLog=function(t){this.library.logger.dumpLog(t)},p.prototype.addSlot=function(t){!n.isObject(t)||n.isArray(t.bidProviders)&&0!==t.bidProviders.length||(t.bidProviders=["__default__"],this.mediator.bidProviderExists_("__default__")||this.mediator.addBidProvider(s)),this.pushApiCall_("api.addSlot",arguments);var e=this.mediator.addSlot(t);return this.requiredApiCalls.addSlot++,e},p.prototype.getSlots=function(){this.pushApiCall_("api.getSlots",arguments);var t=[];for(var e in this.mediator.slotMap)t.push(this.mediator.slotMap[e]);return t},p.prototype.getSlot=function(t){return this.pushApiCall_("api.getSlot",arguments),this.mediator.slotMap[t]},p.prototype.setAuctionProvider=function(t){this.pushApiCall_("api.setAuctionProvider",arguments);var e=this.mediator.setAuctionProvider(t),i=t&&t.name?t.name:"undefined";return e?(this.requiredApiCalls.setAuctionProvider++,e):(this.configErrors.push("Invalid auction provider: "+i),null)},p.prototype.getAuctionProvider=function(){return this.pushApiCall_("api.getAuctionProvider",arguments),this.mediator.auctionProvider},p.prototype.addBidProvider=function(t){this.pushApiCall_("api.addBidProvider",arguments);var e=this.mediator.addBidProvider(t),i=t&&t.name?t.name:"undefined";return e?(this.requiredApiCalls.addBidProvider++,"function"===n.asType(t.init)&&3!==t.init.length&&this.configErrors.push("Bid provider "+i+"'s init method requires 3 arguments"),"function"===n.asType(t.refresh)&&3!==t.refresh.length&&this.configErrors.push("Bid provider "+i+"'s refresh method requires 3 arguments"),e):(this.configErrors.push("Invalid bid provider: "+i),null)},p.prototype.getBidProviders=function(){return this.pushApiCall_("api.getBidProviders",arguments),this.mediator.bidProviders},p.prototype.getBidProvider=function(t){return this.pushApiCall_("api.getBidProvider",arguments),this.mediator.bidProviders[t]},p.prototype.observe=function(t,e){if(this.pushApiCall_("api.observe",arguments),"function"==typeof t)for(var i in r.EVENT_TYPE)r.on(r.EVENT_TYPE[i],n.bind(t,this));else"string"==typeof t&&(r.EVENT_TYPE[t]?r.on(r.EVENT_TYPE[t],n.bind(e,this)):r.publish(r.EVENT_TYPE.WARN,'Warning: Invalid event type "'+t+'"'));return this},p.prototype.timeout=function(t){return this.pushApiCall_("api.timeout",arguments),this.mediator.timeout(t),this},p.prototype.doneCallbackOffset=function(t){this.mediator.doneCallbackOffset(t)},p.prototype.setAuctionTrigger=function(t){return this.pushApiCall_("api.setAuctionTrigger",arguments),this.mediator.setAuctionTrigger(t),this},p.prototype.addBidTransform=function(t){return this.pushApiCall_("api.addBidTransform",arguments),this.mediator.addBidTransform(t),this},p.prototype.addRequestTransform=function(t){return this.pushApiCall_("api.addRequestTransform",arguments),this.mediator.addRequestTransform(t),this},p.prototype.start=function(t,e){this.pushApiCall_("api.start",arguments);var i=u(this);return"function"==typeof e&&e(i.hasError,i.details),i.hasError||this.mediator.start(this.randomizeBidRequests_,t),this},p.prototype.refresh=function(t){return this.pushApiCall_("api.refresh",arguments),this.mediator.refresh(t),this},p.prototype.prefixDefaultBidKey=function(t){return this.mediator.prefixDefaultBidKey(t),this},p.prototype.omitDefaultBidKey=function(t){return this.mediator.omitDefaultBidKey(t),this},p.prototype.library=i.library,e.pubfood=i,i})},{"./errors":5,"./event":6,"./interfaces":7,"./logger":8,"./mediator/auctionmediator":9,"./util":16}],15:[function(t,e,i){"use strict";function r(){this.id=n.newId(),this.params_={}}var n=t("./util");r.prototype.setParam=function(t,e){var i=n.asType(t);return"object"!==i&&"array"!==i&&"function"!==i&&"undefined"!==i&&(this.params_[t]=e),this},r.prototype.getParam=function(t){return this.params_[t]},r.prototype.getParamKeys=function(){var t=[];for(var e in this.params_)t.push(this.params_[e]);return t},e.exports=r},{"./util":16}],16:[function(t,e,i){"use strict";var r={asType:function(t){return{}.toString.call(t).match(/\s([a-zA-Z]+)/)[1].toLowerCase()},newId:function(){return(+new Date).toString(36)+"xxxxxxxxxx".replace(/[x]/g,function(){return(0|36*Math.random()).toString(36)})},"extends":function(t,e){for(var i in e.prototype)t.prototype[i]=e.prototype[i];t.prototype.parents=t.prototype.parents||[],t.prototype.parents.push(function(){return e}),t.prototype.init_=function(){for(var t=this.parents||[],e=0;e<t.length;e++)t[e]().call(this)}},hasFunctions:function(t,e){if(!t)return!1;for(var i=!0,n=0;n<e.length;n++){var o=e[n];if(!t[o]||"function"===!r.asType(t[o])){i=!1;break}}return i},loadUri:function(t,e){var i=document,r=t||"";if(e)if("complete"===i.readyState||"loaded"===i.readyState);else try{i.write('<script src="'+r+'"></script>')}catch(n){}else{var o=document.createElement("script");o.async=!0,o.src=r,(i.head||i.body||i.documentElement).appendChild(o)}},bind:function(t,e){return function(){t.apply(e,Array.prototype.slice.call(arguments))}},mergeToObject:function(t,e){for(var i in e)e.hasOwnProperty(i)&&(this.isObject(e[i])?(t[i]||(t[i]={}),this.mergeToObject(t[i],e[i])):this.isArray(e[i])?(t[i]||(t[i]=[]),this.mergeToArray(t[i],e[i])):t[i]=e[i]);return t},mergeToArray:function(t,e){for(var i=0;i<e.length;i++)t.push(this.clone(e[i]));return t},isArray:function(t){return!!t&&"array"===this.asType(t)},isObject:function(t){return!!t&&"object"===this.asType(t)},clone:function(t){return this.isObject(t)?this.cloneObject(t):this.isArray(t)?this.cloneArray(t):t},cloneArray:function(t){return this.mergeToArray([],t)},cloneObject:function(t){return this.mergeToObject({},t)},values:function(t){var e=[];for(var i in t)e.push(t[i]);return e},validate:function(t,e){if(!e)return!1;var i=0;for(var n in t)if("optional"!==n){var o=!!t.optional&&!!t.optional[n],s=e.hasOwnProperty(n),a=this.asType(e[n]),u=!e.init,p=!0;if(("null"===a||"undefined"===a||"number"===a&&!isFinite(e[n])||"string"===a&&""===e[n])&&(p=!1),o||s&&p||++i,p&&u&&r.isArray(e[n])&&0===e[n].length&&++i,p&&!u&&r.asType(e[n])!==r.asType(t[n])&&++i,i>0)break}return!i}};r.randomize=function(t){for(var e,i,r=t.length;r;)i=Math.floor(Math.random()*r--),e=t[r],t[r]=t[i],t[i]=e;return t},e.exports=r},{}]},{},[14])(14)});
// END pubfood

// START helper functions
var logBWToNR = function(bdr,bd,slt,unt) {
    var bw_datas = {
        'bdr': bdr,
        'bd': parseFloat(bd),
        'slot': slt,
        'unit': unt
    };
    try {
        newrelic.addPageAction('Pubfood_Bid_Win', bw_datas);
        console.log("logged nr PubFood_Bid_Win = ");
        console.log(bw_datas);

    } catch (err) {}
};


var arrayUnion = function(a,b) {
    var arrc = [];
    for (var aidx = 0; aidx < a.length; aidx++) {
        if (b.indexOf(a[aidx]) != -1) {
            arrc.push(a[aidx])
        }
    }
    return arrc;
};
// END helper functions


// START common ad variable initializations
var spAdConfig;
var enabledProviders = ["aol","amazon"];
window.googletag = window.googletag || {};
googletag.cmd = googletag.cmd || [];
var gptadslots = [];
// END common ad variable initializations

SP_OBJ.ADS = {

    "ZONE" : SP_OBJ.SESSION.PAGE_TYPE,

    initialize: function () {
        this.adsIsMobile = SP_OBJ.SESSION.IS_MOBILE;

        // current session depth and platform
        this.currDepth = SP_OBJ.SESSION.PAGE_DEPTH;
        this.providerTimeout = this.currDepth == 0 ? (this.adsIsMobile ? 4000 : 2750) : (this.adsIsMobile ? 2750 : 2250);

        SP_OBJ.ADS.pf = new pubfood({
            auctionProviderCbTimeout: 2000,
            bidProviderCbTimeout: this.providerTimeout,
            randomizeBidRequests: true
        });
        SP_OBJ.ADS.pf.timeout(this.providerTimeout);

        this.timeReference = +(new Date());
    },

    defineSlotsAndAuctionProvider: function () {
        for (var i = 0; i < spAdConfig.slots.length; i++) {
            if(spAdConfig.slots[i].adZones.indexOf(SP_OBJ.ADS.ZONE) !== -1 && spAdConfig.slots[i].isMobile === SP_OBJ.ADS.adsIsMobile){
                SP_OBJ.ADS.pf.addSlot(spAdConfig.slots[i]);
            }
        }

        SP_OBJ.ADS.pf.setAuctionProvider({
            name: 'Google',
            libUri: '//www.googletagservices.com/tag/js/gpt.js',
            init: function(targeting, done) {
                googletag.cmd.push(function() {
                    var i;
                    for (i = 0; i < targeting.length; i++) {
                        var slot = targeting[i];

                        var gptslot = googletag.defineSlot(slot.name, slot.sizes, slot.elementId).addService(googletag.pubads());
                        gptadslots[slot.elementId] = gptslot;

                        for (var p in slot.targeting) {
                            if (slot.targeting.hasOwnProperty(p)) {
                                gptslot.setTargeting(p, slot.targeting[p]);
                            }
                        }
                    }
                    googletag.pubads().setTargeting('sess_depth', SP_OBJ.ADS.currDepth);
                    googletag.pubads().setTargeting('utm_source', SP_OBJ.SESSION.SOURCE);
                    googletag.pubads().setTargeting('utm_camp', SP_OBJ.SESSION.CAMPAIGN);
                    googletag.pubads().setTargeting('utm_medium', SP_OBJ.SESSION.MEDIUM);
                    googletag.pubads().setTargeting('utm_term', SP_OBJ.SESSION.TERM);
                    googletag.pubads().setTargeting('utm_cont', SP_OBJ.SESSION.CONTENT);
                    googletag.pubads().setTargeting('test', SP_OBJ.SESSION.TEST);
                    googletag.pubads().setTargeting('page_type', SP_OBJ.SESSION.PAGE_TYPE);
                    googletag.pubads().setTargeting('tag', SP_OBJ.SESSION.TAGS);
                    googletag.pubads().setTargeting('post_id', SP_OBJ.SESSION.POST_ID);
                    googletag.pubads().setTargeting('explicit', SP_OBJ.SESSION.IS_EXPLICIT);
                    googletag.pubads().setTargeting('post_slug', SP_OBJ.SESSION.POST_SLUG);
                    // googletag.pubads().setTargeting("ybot",yieldbot.getPageCriteria());
                });
                googletag.cmd.push(function() {
                    googletag.enableServices();
                    done();
                });
            },
            refresh: function(targeting, done) {}
        });
    },

    calcBidVal: function (bid_price, rev_share, penny_amount) {
        rev_share = typeof rev_share !== 'undefined' ? rev_share : 1;
        penny_amount = typeof penny_amount !== 'undefined' ? penny_amount : 1;
        var cents_bid = bid_price;

        cents_bid = cents_bid * rev_share;

        if(isNaN(cents_bid)){
            final_bid = 0;
        }
        else{
            if (cents_bid <= 1) {
                final_bid = Math.round((Math.round(cents_bid * 20)/ 20)*100);
            } else if(cents_bid > 1 && cents_bid <= 5) {
                final_bid = Math.round((Math.round(cents_bid * 10)/ 10)*100);
            } else if (cents_bid > 5 && cents_bid <= 10) {
                final_bid = Math.round((Math.round(cents_bid * 4)/ 4)*100);
            } else if (cents_bid > 10 && cents_bid <= 20) {
                final_bid = Math.round((Math.round(cents_bid * 2)/ 2)*100);
            } else {
                final_bid = 2000;
            }
        }

        if(!penny_amount){
            final_bid = final_bid/100;
        }
        return final_bid;
    },

    setupBidProviders: function () {
        for (var bidder in this.bidders) {
            if (this.bidders.hasOwnProperty(bidder) && enabledProviders.indexOf(bidder) != -1) {
                this.bidders[bidder].setup();
            }
        }
    },

    defineBidProviders: function () {
        for (var bidder in this.bidders) {
            if (this.bidders.hasOwnProperty(bidder) && enabledProviders.indexOf(bidder) != -1) {
                SP_OBJ.ADS.pf.addBidProvider({
                    name: bidder,
                    libUri: this.bidders[bidder].getScriptPath(),
                    init: this.bidders[bidder].init,
                    refresh: this.bidders[bidder].refresh
                });
            }
        }
    },

    defineRenderFunctions: function () {

        window.aol_render = function (e, slt) {
            try {
                var bid_obj = SP_OBJ.ADS.aolBids[slt];
                var aol_ad = decodeURIComponent(bid_obj.adm);
                e.write(aol_ad);
            } catch (err) {}

            try {
                var pxls = decodeURIComponent(SP_OBJ.ADS.aolPixels[slt]);
                if (pxls != 'undefined') {
                    e.write(pxls);
                }
            } catch (err) {}

            try {
                var unit = spAdConfig.aolConfig[slt].slotName;
                logBWToNR('aol', bid_obj.final_bid, slt, unit);
            } catch (err) {}
        };

        window.amazon_render = function (e, t) {
            try {
                var i = SP_OBJ.ADS.amazonBids[t];
                logBWToNR("amazon", i.bid, t)
            } catch (o) {}
        };

        window.appnexus_render = function(e,adid,bid,slt) {
            try {
                var anslot = aolConfig.appnexusConfig[slt];
                var ad_url = aolConfig.appnexusBids[slt].ad;
                var bid_dims = aolConfig.appnexusBids[slt].dims;
                e.write('<IFRAME SRC="' + ad_url + '" FRAMEBORDER="0" SCROLLING="no" MARGINHEIGHT="0" MARGINWIDTH="0" TOPMARGIN="0" LEFTMARGIN="0" ALLOWTRANSPARENCY="true" WIDTH="' + bid_dims.width + '" HEIGHT="' + bid_dims.height + '"></IFRAME>');
                e.close();

                if (e.defaultView && e.defaultView.frameElement) {
                    e.defaultView.frameElement.width = bid_dims.width;
                    e.defaultView.frameElement.height = bid_dims.height;
                }
            } catch (err) {}

            try {
                var unit = anslot.slotName;
                var an_bid = aolConfig.appnexusBids[slt].bid;
                logBWToNR('an', an_bid, slt, unit);
            } catch (err) {}
        };
    },

    setupPubfoodLogging: function () {
        var bidProviderTimeouts = {
            'mobile': SP_OBJ.ADS.adsIsMobile,
            'session_depth': SP_OBJ.ADS.currDepth
        };
        bidProviderTimeouts['mobile'] = this.adsIsMobile;
        var bpTimeout;
        var auctionID;
        SP_OBJ.ADS.pf.observe(function(ev) {
            console.log(ev);

            var elapsed = ev.ts - SP_OBJ.ADS.timeReference;
            if ((ev.type || '').match(/COMPLETE$/)) {
                try {
                    if (ev.type == 'AUCTION_COMPLETE') {
                        var targeting = ev.data.targeting;
                        auctionID = ev.auctionId;
                        bidProviderTimeouts['auction_id'] = auctionID;
                        for (var i = 0; i < targeting.length; i++) {
                            var slt = targeting[i];
                            var targetingDict = slt.targeting;
                            var bidProviderBid = {
                                'ad_slot': slt.name,
                                'mobile': SP_OBJ.ADS.adsIsMobile,
                                'session_depth': SP_OBJ.ADS.currDepth,
                                'auction_id': auctionID
                            };
                            for (var key in targetingDict) {
                                if (targetingDict.hasOwnProperty(key)) {
                                    try {
                                        bidProviderBid[key] = JSON.parse(targetingDict[key]);
                                    } catch (err) {}
                                }
                            }
                            try {
                                // console.log(bidProviderBid);
                                var centbids = ["aol_bid", "sovrn_bid", "openx_bid", "yieldbot_bid", "appnexus_bid"];
                                var dollarbids = ["sonobi_bid", "amazon_bid", "pubmatic_bid"];
                                var allbids = centbids.concat(dollarbids);
                                for(var key in bidProviderBid){
                                    if(centbids.indexOf(key) !== -1){
                                        bidProviderBid[key] = bidProviderBid[key]/100;
                                    }
                                    // if(allbids.indexOf(key) !== -1){
                                    console.log("logged nr PubFood_Bid = ");
                                    console.log(bidProviderBid);
                                    newrelic.addPageAction('PubFood_Bid', bidProviderBid);
                                    // }
                                }
                            } catch (err) {}
                        }
                        try {
                            console.log("logged nr PubFood_Timeouts = ");
                            console.log(bidProviderTimeouts);
                            newrelic.addPageAction('PubFood_Timeouts', bidProviderTimeouts);
                        } catch (err) {}
                    }

                    if (ev.type == 'BID_COMPLETE') {
                        bpTimeout = ev.data + '_timeout';
                        bidProviderTimeouts[bpTimeout] = elapsed;
                    }
                } catch (err) {}
            }
        });
    },

    runAuction: function () {
        var onStart = function(hasErrors, details){
            if(hasErrors){
                console.log('error details', details);
            }else {
                //console.log('no error');
            }
        };
        SP_OBJ.ADS.pf.start(SP_OBJ.ADS.timeReference, onStart);
    },

    loadScript: function (scriptUrl) {
        var adScript = document.createElement('script');
        adScript.type = 'text/javascript';
        adScript.async = true;
        adScript.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + scriptUrl;
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(adScript, s);
    },


    bidders: {

        'aol': {
            setup: function () {
                SP_OBJ.ADS.aolBids = {};
                SP_OBJ.ADS.aolPixels = {};
            },

            getScriptPath: function () {
                return ' '
            },

            init: function (slots, pushBid, done) {

                var aolCounter = 0;
                var aolTotal = 0;

                for (var x=0; x < spAdConfig.slots.length; x++){
                    if (spAdConfig.slots[x].isMobile === SP_OBJ.ADS.adsIsMobile && spAdConfig.slots[x]["adZones"].indexOf(SP_OBJ.ADS.ZONE) !== -1){
                        for (var index in spAdConfig.aolConfig){
                            if(spAdConfig.aolConfig[index]["slotName"] === spAdConfig.slots[x].name && spAdConfig.aolConfig[index]["isMobile"] === SP_OBJ.ADS.adsIsMobile){
                                aolTotal++;
                            }
                        }
                    }
                }

                SP_OBJ.ADS.aolCallbacks = {};
                window.aolCallback = function (response, aolSlot) {
                    if (typeof response.ext !== 'undefined' && typeof response.ext.pixels !== 'undefined') SP_OBJ.ADS.aolPixels[aolSlot] = response.ext.pixels;
                    try {
                        var slot_resp = response.seatbid[0].bid[0];
                        if (typeof slot_resp.ext !== 'undefined' && typeof slot_resp.ext.pixels !== 'undefined') {
                            SP_OBJ.ADS.aolPixels[aolSlot] = slot_resp.ext.pixels;
                        }
                        SP_OBJ.ADS.aolBids[aolSlot] = slot_resp;

                        var aol_bid = SP_OBJ.ADS.calcBidVal(slot_resp.price, 0.80);
                        SP_OBJ.ADS.aolBids[aolSlot].final_bid = aol_bid;

                        var sizes = [spAdConfig.aolConfig[aolSlot]['banner']['w'], spAdConfig.aolConfig[aolSlot]['banner']['h']];
                        var auction_slot = 'undefined_slot';
                        for (var k = 0; k < slots.length; k++) {
                            var slot = slots[k];
                            if (slot.name == spAdConfig.aolConfig[aolSlot].slotName) {
                                auction_slot = slot.name;
                                break;
                            }
                        }

                        var slotTargeting = {};
                        slotTargeting.mpalias = aolSlot;
                        slotTargeting.aolbid = aol_bid;

                        var bidObject = {
                            slot: auction_slot,
                            value: aol_bid,
                            sizes: sizes,
                            targeting: slotTargeting
                        };
                        pushBid(bidObject);

                    } catch (err) {}

                    aolCounter++;
                    if (aolCounter == aolTotal) {
                        done();
                    }
                };

                for (var x=0; x < spAdConfig.slots.length; x++){
                    if (spAdConfig.slots[x].isMobile === SP_OBJ.ADS.adsIsMobile && spAdConfig.slots[x]["adZones"].indexOf(SP_OBJ.ADS.ZONE) !== -1){
                        for (var index in spAdConfig.aolConfig){
                            if(spAdConfig.aolConfig[index]["slotName"] === spAdConfig.slots[x].name && spAdConfig.aolConfig[index]["isMobile"] === SP_OBJ.ADS.adsIsMobile){

                                aol_alias = index;
                                var aol_slot = spAdConfig.aolConfig[index];
                                var aolSizeId = aol_slot.sizeId;


                                SP_OBJ.ADS.aolCallbacks[index] = (function (inner_alias) {
                                    return function (response) {
                                        window.aolCallback(response, inner_alias)
                                    };
                                }(index));

                                var req_url = 'adserver.adtechus.com/pubapi/3.0/10521.1/';
                                req_url += aol_slot.placement;
                                req_url += '/0/' + aolSizeId + '/ADTECH;cmd=bid;';
                                req_url += 'callback=SP_OBJ.ADS.aolCallbacks.'+index+';';
                                req_url += 'misc='+ 1e18 * Math.random();
                                SP_OBJ.ADS.loadScript(req_url);
                            }
                        }
                    }
                }
            },

            refresh: function (slots, pushBid, done) {}
        },

        'amazon': {
            setup: function () {
                window.amznads = window.amznads || [], SP_OBJ.ADS.amazonBids = {};
            },

            getScriptPath: function () {
                return '//c.amazon-adsystem.com/aax2/amzn_ads.js';
            },

            init: function (slots, pushBid, done) {
                amznads.asyncParams = {
                    'id': '3388',
                    'callbackFn': function() {
                        try {
                            var pfSlots = SP_OBJ.ADS.pf.getSlots();
                            //var azbids = amznads.getTargeting().amznslots;
                            var azbids = ['a3x2t1', 'a3x2t2', 'a7x9t1', 'a7x9t2'];
                            for (var x in pfSlots){
                                for (var y in azbids){
                                    var azbidkey = azbids[y];
                                    var azbid = spAdConfig.amazonConfig.price["t" + azbidkey.split("t")[1]]
                                    var azsize = spAdConfig.amazonConfig.size[azbidkey.split("t")[0]];
                                    var bidObject = {
                                        slot: pfSlots[x].name,
                                        value: azbid,
                                        sizes: azsize
                                    };
                                    SP_OBJ.ADS.amazonBids[azbidkey] = {
                                        bid: bidObject
                                    };
                                    pushBid(bidObject);
                                }
                            }
                        } catch (d) {
                        }
                        try {
                            amznads.setTargetingForGPTAsync("amznslots");
                        } catch (d) {}
                        done();
                    },
                    'timeout': 2e3
                };
            },

            refresh: function (slots, pushBid, done) {}
        },

        'appnexus': {
            setup: function () {
                SP_OBJ.ADS.appnexusBids = {}
            },

            getScriptPath: function () {
                return ' '
            },

            init: function (slots, pushBid, done) {
                window.appnexuscallback = function (response) {
                    var slt = response.callback_uid;
                    var result = response.result;
                    var an_bid = result.cpm / 10000;
                    an_bid = SP_OBJ.ADS.calcBidVal(an_bid);
                    var anSlot = spAdConfig.appnexusConfig[slt];
                    var sizes = [result.width, result.height];

                    SP_OBJ.ADS.appnexusBids[slt] = {
                        'ad': result.ad,
                        'bid': an_bid,
                        'dims': {
                            'width': result.width,
                            'height': result.height
                        }
                    };

                    var slotTargeting = {};
                    slotTargeting[slt] = an_bid;

                    slotTargeting['an_slot'] = slt;
                    slotTargeting['an_bid'] = an_bid;
                    slotTargeting['an_adid'] = '';
                    slotTargeting['an_size'] = result.width+'x'+result.height;

                    var bidObject = {
                        slot: anSlot.slotName,
                        value: an_bid,
                        sizes: sizes,
                        targeting: slotTargeting
                    };
                    pushBid(bidObject);
                    anCounter++;

                    if (anCounter == anTotal) {
                        done();
                    }
                };

                var anCounter = 0;
                var anTotal = 0;

                for (var x in spAdConfig.slots){
                    if (spAdConfig.slots[x].isMobile === SP_OBJ.ADS.adsIsMobile && spAdConfig.slots[x]["adZones"].indexOf(SP_OBJ.ADS.ZONE) !== -1){
                        for (var index in spAdConfig.appnexusConfig){
                            if(spAdConfig.appnexusConfig[index]["slotName"] === spAdConfig.slots[x].name && spAdConfig.appnexusConfig[index]["isMobile"] === SP_OBJ.ADS.adsIsMobile){
                                anTotal++;
                            }
                        }
                    }
                }

                for (var x=0; x < spAdConfig.slots.length; x++) {
                    if (spAdConfig.slots[x].isMobile === SP_OBJ.ADS.adsIsMobile && spAdConfig.slots[x]["adZones"].indexOf(SP_OBJ.ADS.ZONE) !== -1) {
                        for (var slt in spAdConfig.appnexusConfig) {
                            if (spAdConfig.appnexusConfig[slt]["slotName"] === spAdConfig.slots[x].name && spAdConfig.appnexusConfig[slt]["isMobile"] === SP_OBJ.ADS.adsIsMobile) {
                                var anSlot = spAdConfig.appnexusConfig[slt];

                                var slSizes;
                                for (var as = 0; as < spAdConfig.slots.length; as++) {
                                    var asl = spAdConfig.slots[as];
                                    if (asl.name == anSlot.slotName) {
                                        slSizes = asl.sizes;
                                        break;
                                    }
                                }

                                var primarySize = slSizes[0];

                                var referrer = encodeURI(location.href);
                                var size = primarySize[0] + 'x' + primarySize[1];

                                var promo_sizes = [];
                                for (var sz = 1; sz < slSizes.length; sz++) {
                                    var siz = slSizes[sz];
                                    promo_sizes.push(siz[0] + 'x' + siz[1]);
                                }
                                promo_sizes.join(',');

                                var requrl = 'ib.adnxs.com/jpt?id='+
                                    anSlot.placement+
                                    '&psa=0&size='+size+
                                    '&promo_sizes='+promo_sizes+
                                    '&referrer='+referrer+
                                    '&callback=window.appnexuscallback&callback_uid='+slt+
                                    '&misc='+ 1e18 * Math.random();
                                if (window.console) {
                                    console.log(requrl);
                                }
                                SP_OBJ.ADS.loadScript(requrl);
                            }
                        }
                    }
                }
            },

            refresh: function (slots, pushBid, done) {}
        }
    }
};

spAdConfig = {
    slots: [
        /*Header*/
        {
            name: '/76778142/Itsthevibe_Header_Ad',
            sizes: [[320, 50],[320, 100]],
            elementId: 'div-gpt-ad-1460507361888-3',
            isMobile: true,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["home"]],
            bidProviders: arrayUnion(["aol"], enabledProviders)
        },
        {
            name: '/76778142/Itsthevibe_Header_Ad',
            sizes: [[728, 90]],
            elementId: 'div-gpt-ad-1460507361888-3',
            isMobile: false,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["home"]],
            bidProviders: arrayUnion(["aol","amazon"], enabledProviders)
        },
        /*Below Featured*/
        {
            name: '/76778142/Itsthevibe_BelowFeatured_Ad',
            sizes: [[320, 50],[320, 100]],
            elementId: 'div-gpt-ad-1460507361888-0',
            isMobile: true,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["home"]],
            bidProviders: arrayUnion(["aol"], enabledProviders)
        },
        {
            name: '/76778142/Itsthevibe_BelowFeatured_Ad',
            sizes: [[728, 90]],
            elementId: 'div-gpt-ad-1460507361888-0',
            isMobile: false,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["home"]],
            bidProviders: arrayUnion(["aol","amazon"], enabledProviders)
        },
        /*Article RR*/
        {
            name: '/76778142/Itsthevibe_PostPage_Ad_Top',
            sizes: [[300, 250]],
            elementId: 'div-gpt-ad-1461545772821-22',
            isMobile: false,
            adZones: [],
            bidProviders: arrayUnion(["aol","amazon"], enabledProviders)
        },
        {
            name: '/76778142/Itsthevibe_PostPage_Ad_Mid',
            sizes: [[300, 600],[160,600],[300,250]],
            elementId: 'div-gpt-ad-1461545772821-23',
            isMobile: false,
            adZones: [],
            bidProviders: arrayUnion(["aol"], enabledProviders)
        },
        /*Other RR*/
        {
            name: '/76778142/Itsthevibe_Sidebar_Ad_Top',
            sizes: [[300, 250]],
            elementId: 'div-gpt-ad-1461545772821-2',
            isMobile: false,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["article"], SP_OBJ.SESSION.PAGE_TYPES["category"], SP_OBJ.SESSION.PAGE_TYPES["gallery"], SP_OBJ.SESSION.PAGE_TYPES["end-gallery"], SP_OBJ.SESSION.PAGE_TYPES["404"]],
            bidProviders: arrayUnion(["aol","amazon"], enabledProviders)
        },
        {
            name: '/76778142/Itsthevibe_Sidebar_Ad_Mid',
            sizes: [[300, 600],[160,600],[300,250]],
            elementId: 'div-gpt-ad-1461545772821-1',
            isMobile: false,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["article"], SP_OBJ.SESSION.PAGE_TYPES["category"], SP_OBJ.SESSION.PAGE_TYPES["gallery"], SP_OBJ.SESSION.PAGE_TYPES["end-gallery"], SP_OBJ.SESSION.PAGE_TYPES["404"]],
            bidProviders: arrayUnion(["aol","amazon"], enabledProviders)
        },
        {
            name: '/76778142/Itsthevibe_Sidebar_Ad_Bottom',
            sizes: [[300, 250]],
            elementId: 'div-gpt-ad-1460507361888-2',
            isMobile: false,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["category"]],
            bidProviders: arrayUnion(["aol","amazon"], enabledProviders)
        },
        /*Slideshow Content ONLY SINGLE POST*/
        {
            name: '/76778142/Itsthevibe_InPost_Ad_Top',
            sizes: [[320, 50],[320, 100]],
            elementId: 'div-gpt-ad-1460507361888-8',
            isMobile: true,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["gallery"], SP_OBJ.SESSION.PAGE_TYPES["end-gallery"]],
            bidProviders: arrayUnion(["aol"], enabledProviders)
        },
        {
            name: '/76778142/Itsthevibe_InPost_Ad_Top',
            sizes: [[728, 90]],
            elementId: 'div-gpt-ad-1460507361888-8',
            isMobile: false,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["gallery"], SP_OBJ.SESSION.PAGE_TYPES["end-gallery"]],
            bidProviders: arrayUnion(["aol","amazon"], enabledProviders)
        },
        {
            name: '/76778142/Itsthevibe_InPost_Ad_Mid_Left',
            sizes: [[300, 250],[336, 280]],
            elementId: 'div-gpt-ad-1460507361888-10',
            isMobile: false,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["gallery"]],
            bidProviders: arrayUnion(["aol","amazon"], enabledProviders)
        },
        {
            name: '/76778142/Itsthevibe_InPost_Ad_Mid_Right',
            sizes: [[300, 250],[336, 280]],
            elementId: 'div-gpt-ad-1461545772821-0',
            isMobile: false,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["gallery"]],
            bidProviders: arrayUnion(["aol","amazon"], enabledProviders)
        },
        {
            name: '/76778142/Itsthevibe_InPost_Ad_Mid',
            sizes: [[320, 50], [320, 100]],
            elementId: 'div-gpt-ad-1461545772821-23',
            isMobile: true,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["gallery"]],
            bidProviders: arrayUnion(["aol"], enabledProviders)
        },
        {
            name: '/76778142/Itsthevibe_BelowPost_Ad',
            sizes: [[320, 50],[320, 100]],
            elementId: 'div-gpt-ad-1460507361888-1',
            isMobile: true,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["gallery"], SP_OBJ.SESSION.PAGE_TYPES["end-gallery"]],
            bidProviders: arrayUnion(["aol"], enabledProviders)
        },
        {
            name: '/76778142/Itsthevibe_BelowPost_Ad',
            sizes: [[728, 90]],
            elementId: 'div-gpt-ad-1460507361888-1',
            isMobile: false,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["gallery"], SP_OBJ.SESSION.PAGE_TYPES["end-gallery"]],
            bidProviders: arrayUnion(["aol","amazon"], enabledProviders)
        }
    ],

    aolConfig: {
        /*inpost top*/
        "itvaol728x90ipt": {
            "placement": 3997266,
            "banner": {"w": 728, "h": 90},
            "sizeId": 225,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Top",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        "itvaol320x50mipt": {
            "placement": 3997292,
            "banner": {"w": 320, "h": 50},
            "sizeId": 3055,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Top",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        "itvaol300x250mipt": {
            "placement": 3997289,
            "banner": {"w": 300, "h": 250},
            "sizeId": 170,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Top",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        /*inpost mid*/
        "itvaol320x50mipm": {
            "placement": 3997294,
            "banner": {"w": 320, "h": 50},
            "sizeId": 3055,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Mid",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        "itvaol300x250mipm": {
            "placement": 3997296,
            "banner": {"w": 300, "h": 250},
            "sizeId": 170,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Mid",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        "itvaol300x250ipml": {
            "placement": 3997270,
            "banner": {"w": 300, "h": 250},
            "sizeId": 170,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Mid_Left",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        "itvaol300x250ipmr": {
            "placement": 3997268,
            "banner": {"w": 300, "h": 250},
            "sizeId": 170,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Mid_Right",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        /*Below Featured*/
        "itvaol320x50mbf": {
            "placement": 3997297,
            "banner": {"w": 320, "h": 50},
            "sizeId": 3055,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_BelowFeatured_Ad",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        "itvaol300x250mbf": {
            "placement": 3997293,
            "banner": {"w": 300, "h": 250},
            "sizeId": 170,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_BelowFeatured_Ad",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        "itvaol728x90bf": {
            "placement": 3997265,
            "banner": {"w": 728, "h": 90},
            "sizeId": 225,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_BelowFeatured_Ad",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },

        "itvaol300x250mbp": {
            "placement": 3997304,
            "banner": {"w": 300, "h": 250},
            "sizeId": 170,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_BelowPost_Ad",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        "itvaol728x90bp": {
            "placement": 3997275,
            "banner": {"w": 728, "h": 90},
            "sizeId": 225,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_BelowPost_Ad",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },

        /*Header*/
        "itvaol320x50mh": {
            "placement": 3997291,
            "banner": {"w": 320, "h": 50},
            "sizeId": 3055,
            "isMobile": true,
            "slotName": '/76778142/Itsthevibe_Header_Ad',
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        "itvaol728x90h": {
            "placement": 3997274,
            "banner": {"w": 728, "h": 90},
            "sizeId": 225,
            "isMobile": false,
            "slotName": '/76778142/Itsthevibe_Header_Ad',
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        /*Article RR*/

        /*Other RR*/
        "itvaol300x250rrt": {
            "placement": 3997269,
            "banner": {"w": 300, "h": 250},
            "sizeId": 170,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_Sidebar_Ad_Top",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        "itvaol300x600rrm": {
            "placement": 3997271,
            "banner": {"w": 300, "h": 600},
            "sizeId": 529,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_Sidebar_Ad_Mid",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        "itvaol300x250rrb": {
            "placement": 3997272,
            "banner": {"w": 300, "h": 250},
            "sizeId": 170,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_Sidebar_Ad_Bottom",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        },
        /*LR*/
        "itvaol160x600lr": {
            "placement": 3997273,
            "banner": {"w": 160, "h": 600},
            "sizeId": 154,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_Left_Sidebar_Ad_2",
            "secure": false,
            "performScreenDetection": false,
            "mpAliasKey": 'mpalias'
        }
    },

    appnexusConfig: {
        "an728x90ipt": {
            "placement": 5823281,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Top"
        },
        "an320x50mipt": {
            "placement": 5823300,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Top"
        },
        "an320x50mipm": {
            "placement": 5823309,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Mid"
        },
        "an300x250mipm": {
            "placement": 5823281,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Mid"
        },
        "an300x250ipml": {
            "placement": 5823300,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Mid_Left"
        },
        "an300x250ipmr": {
            "placement": 5823309,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Mid_Right"
        },
        "an728x90ipb": {
            "placement": 5823281,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Bottom"
        },
        "an320x50mipb": {
            "placement": 5823300,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Bottom"
        },
        "an300x250mipb": {
            "placement": 5823309,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_InPost_Ad_Bottom"
        },
        "an728x90bp": {
            "placement": 5823281,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_BelowPost_Ad"
        },
        "an320x50mbp": {
            "placement": 5823300,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_BelowPost_Ad"
        },
        "an320x250mbp": {
            "placement": 5823309,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_BelowPost_Ad"
        },
        "an728x90bf": {
            "placement": 5823281,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_BelowFeatured_Ad"
        },
        "an320x50mbf": {
            "placement": 5823300,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_BelowFeatured_Ad"
        },
        "an320x250mbf": {
            "placement": 5823309,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_BelowFeatured_Ad"
        },
        "an728x90h": {
            "placement": 5823281,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_Header_Ad"
        },
        "an320x50mh": {
            "placement": 5823300,
            "isMobile": true,
            "slotName": "/76778142/Itsthevibe_Header_Ad"
        },
        "an160x600lr": {
            "placement": 5823309,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_Left_Sidebar_Ad_2"
        },
        "an300x250rrt": {
            "placement": 5823281,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_Sidebar_Ad_Top"
        },
        "an300x600rrm": {
            "placement": 5823300,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_Sidebar_Ad_Mid"
        },
        "an300x250rrb": {
            "placement": 5823309,
            "isMobile": false,
            "slotName": "/76778142/Itsthevibe_Sidebar_Ad_Bottom"
        }
    },
    "amazonConfig": {
        "size": {
            "a7x9": "728x90",
            "a7x9": "728x90",
            "a3x2": "300x250",
            "a3x2": "300x250"
        },
        "price": {
            "t1": .02,
            "t2": .01
        }
    }
};

/*LR*/
jQuery(document).ready(function() {
    if(jQuery(".sidebar-secondary").length && jQuery(".sidebar-secondary").css("display") !== "none"){
        spAdConfig.slots.push({
            name: '/76778142/Itsthevibe_Left_Sidebar_Ad_2',
            sizes: [[160, 600]],
            elementId: 'div-gpt-ad-1460507361888-9',
            isMobile: false,
            adZones: [SP_OBJ.SESSION.PAGE_TYPES["gallery"], SP_OBJ.SESSION.PAGE_TYPES["end-gallery"]],
            bidProviders: arrayUnion(["aol"], enabledProviders)
        });
    }
});


SP_OBJ.ADS.initialize();
jQuery(document).ready(function() {
    SP_OBJ.ADS.setupBidProviders();
    SP_OBJ.ADS.defineBidProviders();
    SP_OBJ.ADS.defineSlotsAndAuctionProvider();
    SP_OBJ.ADS.defineRenderFunctions();
    SP_OBJ.ADS.setupPubfoodLogging();
    SP_OBJ.ADS.runAuction();
});


var eAction;
if(SP_OBJ.SESSION.ADS_BLOCKED){
    eAction = "ads blocked";
}
else{
    eAction = "ads not blocked";
}
try{
    console.log("logged nr AdBlockerCheck" + eAction);
    newrelic.addPageAction('AdBlockerCheck', eAction);
} catch (err) {}
