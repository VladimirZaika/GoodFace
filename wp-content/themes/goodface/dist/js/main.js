(function () {
  'use strict';

  function _classCallCheck(a, n) {
    if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function");
  }
  function _defineProperties(e, r) {
    for (var t = 0; t < r.length; t++) {
      var o = r[t];
      o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o);
    }
  }
  function _createClass(e, r, t) {
    return r && _defineProperties(e.prototype, r), Object.defineProperty(e, "prototype", {
      writable: !1
    }), e;
  }
  function _toPrimitive(t, r) {
    if ("object" != typeof t || !t) return t;
    var e = t[Symbol.toPrimitive];
    if (void 0 !== e) {
      var i = e.call(t, r);
      if ("object" != typeof i) return i;
      throw new TypeError("@@toPrimitive must return a primitive value.");
    }
    return (String )(t);
  }
  function _toPropertyKey(t) {
    var i = _toPrimitive(t, "string");
    return "symbol" == typeof i ? i : i + "";
  }

  document.addEventListener('DOMContentLoaded', function () {
    var stickyHeader = /*#__PURE__*/function () {
      function stickyHeader(headerSelector) {
        _classCallCheck(this, stickyHeader);
        this.navbar = document.querySelector(headerSelector);
        this.lastScrollTop = 0;
        this.headerHeight = this.navbar.scrollHeight;
        window.addEventListener('scroll', this.onScroll.bind(this));
        window.addEventListener('load', this.onScroll.bind(this));
      }
      return _createClass(stickyHeader, [{
        key: "onScroll",
        value: function onScroll() {
          var scroll = window.scrollY || document.documentElement.scrollTop;
          if (scroll < 0) scroll = 0;
          if (Math.abs(scroll - this.lastScrollTop) < 2) return;
          if (scroll > this.lastScrollTop) {
            this.navbar.classList.add("scrolled-down");
            this.navbar.classList.remove("scrolled-up");
          } else if (scroll === 0) {
            this.navbar.classList.remove("scrolled-down");
            this.navbar.classList.remove("scrolled-up");
          } else if (scroll < this.lastScrollTop && scroll > 100) {
            this.navbar.classList.remove("scrolled-down");
            this.navbar.classList.add("scrolled-up");
          }
          this.lastScrollTop = scroll;
        }
      }]);
    }();
    if (document.querySelector('header')) {
      new stickyHeader('.header');
      var header = document.querySelector('header');
      var hasChildrenItem = header.querySelectorAll('.menu-item-has-children');
      if (hasChildrenItem.length > 0) {
        hasChildrenItem.forEach(function (item) {
          var link = item.querySelector('a');
          var itemHref = link.getAttribute('href');
          if (itemHref === '#' || itemHref === '') {
            link.addEventListener('click', function (e) {
              e.preventDefault();
            });
          }
          item.addEventListener('pointerdown', function (e) {
            e.preventDefault();
            e.stopPropagation();
            hasChildrenItem.forEach(function (i) {
              if (i !== item) i.classList.remove('active');
            });
            item.classList.toggle('active');
          });
        });
        document.addEventListener('click', function (e) {
          hasChildrenItem.forEach(function (item) {
            if (!item.contains(e.target)) {
              item.classList.remove('active');
            }
          });
        });
        document.addEventListener('keydown', function (e) {
          if (e.key === 'Escape') {
            hasChildrenItem.forEach(function (item) {
              return item.classList.remove('active');
            });
          }
        });
      }
    }
  });

  document.addEventListener('DOMContentLoaded', function () {
    var page = 2;
    var loadMoreBtn = document.querySelector('.load-more-btn-wrapper .button');
    var postWrapper = document.querySelector('.post-cards-wrapper');
    var btnWrapper = document.querySelector('.load-more-btn-wrapper');
    var preloaderWrap = btnWrapper === null || btnWrapper === void 0 ? void 0 : btnWrapper.querySelector('.button-preloader-wrap');
    if (wpData.maxPosts <= 8) {
      btnWrapper === null || btnWrapper === void 0 || btnWrapper.classList.add('d-none');
      return;
    }
    if (loadMoreBtn && postWrapper && btnWrapper) {
      loadMoreBtn.addEventListener('click', function (e) {
        e.preventDefault();
        document.body.classList.add('processing');
        preloaderWrap === null || preloaderWrap === void 0 || preloaderWrap.classList.add('processing');
        var data = new FormData();
        data.append('action', 'load_more_posts');
        data.append('paged', page);
        data.append('id', wpData.id);
        data.append('taxonomy', wpData.taxonomy);
        data.append('post_type', wpData.postType);
        data.append('archive', wpData.archive);
        fetch(wpData.ajaxUrl, {
          method: 'POST',
          body: data
        }).then(function (response) {
          return response.json();
        }).then(function (data) {
          if (data.success && data.data.html) {
            postWrapper.innerHTML += data.data.html;
            if (!data.data.has_more) {
              btnWrapper.classList.add('d-none');
            } else {
              page++;
            }
          } else {
            btnWrapper.classList.add('d-none');
          }
        })["catch"](function (err) {
          console.error('AJAX error:', err);
        })["finally"](function () {
          document.body.classList.remove('processing');
          preloaderWrap === null || preloaderWrap === void 0 || preloaderWrap.classList.remove('processing');
        });
      });
    }
  });

})();
