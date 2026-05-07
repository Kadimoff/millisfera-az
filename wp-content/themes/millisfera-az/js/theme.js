(function () {
  const menuToggle = document.querySelector('[data-menu-toggle]');
  const mobileDrawer = document.querySelector('[data-mobile-drawer]');
  const progress = document.querySelector('[data-reading-progress]');
  const themeToggle = document.querySelector('[data-theme-toggle]');
  const storageKey = 'millisfera-theme';
  var activeFocusTrap = null;

  var getFocusableElements = function (container) {
    if (!container) return [];
    return Array.prototype.slice.call(container.querySelectorAll(
      'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
    )).filter(function (el) {
      return !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length);
    });
  };

  var trapFocus = function (container, event) {
    var focusable = getFocusableElements(container);
    if (!focusable.length) return;
    var first = focusable[0];
    var last = focusable[focusable.length - 1];

    if (event.shiftKey && document.activeElement === first) {
      event.preventDefault();
      last.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
      event.preventDefault();
      first.focus();
    }
  };

  var enableFocusTrap = function (container, returnFocusEl) {
    activeFocusTrap = { container: container, returnFocusEl: returnFocusEl || null };
  };

  var disableFocusTrap = function (container) {
    if (!activeFocusTrap || activeFocusTrap.container !== container) return;
    var focusTarget = activeFocusTrap.returnFocusEl;
    activeFocusTrap = null;
    if (focusTarget && typeof focusTarget.focus === 'function') {
      focusTarget.focus();
    }
  };

  const applyTheme = function (theme) {
    document.documentElement.setAttribute('data-theme', theme);
    if (themeToggle) {
      const isDark = theme === 'dark';
      themeToggle.textContent = isDark ? '☀' : '◐';
      themeToggle.setAttribute('aria-label', isDark ? millisferaTheme.themeToLight : millisferaTheme.themeToDark);
      themeToggle.setAttribute('title', isDark ? millisferaTheme.themeToLight : millisferaTheme.themeToDark);
    }
  };

  try {
    const stored = localStorage.getItem(storageKey);
    if (stored === 'dark' || stored === 'light') {
      applyTheme(stored);
    } else {
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      applyTheme(prefersDark ? 'dark' : 'light');
    }
  } catch (e) {
    applyTheme('light');
  }

  if (menuToggle && mobileDrawer) {
    menuToggle.addEventListener('click', function () {
      const isOpen = mobileDrawer.classList.toggle('open');
      menuToggle.setAttribute('aria-expanded', String(isOpen));
      menuToggle.setAttribute('aria-label', isOpen ? millisferaTheme.menuClose : millisferaTheme.menuOpen);
      mobileDrawer.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
      if (isOpen) {
        enableFocusTrap(mobileDrawer, menuToggle);
        var drawerFocusable = getFocusableElements(mobileDrawer);
        if (drawerFocusable.length) {
          drawerFocusable[0].focus();
        }
      } else {
        disableFocusTrap(mobileDrawer);
      }
    });
  }

  var searchToggle = document.querySelector('[data-search-toggle]');
  var searchOverlay = document.querySelector('[data-search-overlay]');
  var searchInput = document.querySelector('[data-search-input]');
  var searchClose = document.querySelector('[data-search-close]');
  var searchBackdrop = document.querySelector('[data-search-backdrop]');

  var openSearch = function () {
    if (!searchOverlay) return;
    searchOverlay.classList.add('is-open');
    searchOverlay.setAttribute('aria-hidden', 'false');
    if (searchToggle) searchToggle.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
    enableFocusTrap(searchOverlay, searchToggle);
    window.setTimeout(function () {
      if (searchInput) searchInput.focus();
    }, 50);
  };

  var closeSearch = function () {
    if (!searchOverlay) return;
    searchOverlay.classList.remove('is-open');
    searchOverlay.setAttribute('aria-hidden', 'true');
    if (searchToggle) searchToggle.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
    disableFocusTrap(searchOverlay);
  };

  if (searchToggle) {
    searchToggle.addEventListener('click', openSearch);
  }

  if (searchClose) {
    searchClose.addEventListener('click', closeSearch);
  }

  if (searchBackdrop) {
    searchBackdrop.addEventListener('click', closeSearch);
  }

  document.addEventListener('click', function (e) {
    if (!mobileDrawer || !menuToggle || !mobileDrawer.classList.contains('open')) return;
    if (mobileDrawer.contains(e.target) || menuToggle.contains(e.target)) return;
    mobileDrawer.classList.remove('open');
    mobileDrawer.setAttribute('aria-hidden', 'true');
    menuToggle.setAttribute('aria-expanded', 'false');
    menuToggle.setAttribute('aria-label', millisferaTheme.menuOpen);
    disableFocusTrap(mobileDrawer);
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Tab' && activeFocusTrap) {
      trapFocus(activeFocusTrap.container, e);
      return;
    }

    if (e.key === 'Escape' && mobileDrawer && mobileDrawer.classList.contains('open')) {
      mobileDrawer.classList.remove('open');
      mobileDrawer.setAttribute('aria-hidden', 'true');
      if (menuToggle) {
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', millisferaTheme.menuOpen);
      }
      disableFocusTrap(mobileDrawer);
      return;
    }

    if (e.key === 'Escape' && searchOverlay && searchOverlay.classList.contains('is-open')) {
      closeSearch();
    }
  });

  if (themeToggle) {
    themeToggle.addEventListener('click', function () {
      const current = document.documentElement.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
      const next = current === 'dark' ? 'light' : 'dark';
      applyTheme(next);
      try {
        localStorage.setItem(storageKey, next);
      } catch (e) {}
    });
  }

  const slider = document.querySelector('[data-hero-slider]');
  if (slider) {
    const slides = Array.from(slider.querySelectorAll('[data-slide]'));
    const dots = Array.from(slider.querySelectorAll('[data-slide-dot]'));
    const prevButton = slider.querySelector('[data-slide-prev]');
    const nextButton = slider.querySelector('[data-slide-next]');
    const interval = parseInt(slider.getAttribute('data-interval') || '2000', 10);
    let currentIndex = 0;
    let timer = null;
    let touchStartX = 0;
    let touchEndX = 0;

    const showSlide = function (index) {
      if (!slides.length) {
        return;
      }

      currentIndex = (index + slides.length) % slides.length;

      slides.forEach(function (slide, slideIndex) {
        slide.classList.toggle('is-active', slideIndex === currentIndex);
      });

      dots.forEach(function (dot, dotIndex) {
        dot.classList.toggle('is-active', dotIndex === currentIndex);
      });
    };

    const startSlider = function () {
      if (slides.length < 2) {
        return;
      }

      stopSlider();
      timer = window.setInterval(function () {
        showSlide(currentIndex + 1);
      }, Math.max(interval, 1500));
    };

    const stopSlider = function () {
      if (timer) {
        window.clearInterval(timer);
        timer = null;
      }
    };

    dots.forEach(function (dot, idx) {
      dot.addEventListener('click', function () {
        showSlide(idx);
        startSlider();
      });
    });

    if (prevButton) {
      prevButton.addEventListener('click', function () {
        showSlide(currentIndex - 1);
        startSlider();
      });
    }

    if (nextButton) {
      nextButton.addEventListener('click', function () {
        showSlide(currentIndex + 1);
        startSlider();
      });
    }

    slider.addEventListener(
      'touchstart',
      function (event) {
        if (!event.changedTouches || !event.changedTouches.length) {
          return;
        }
        touchStartX = event.changedTouches[0].clientX;
        touchEndX = touchStartX;
        stopSlider();
      },
      { passive: true }
    );

    slider.addEventListener(
      'touchmove',
      function (event) {
        if (!event.changedTouches || !event.changedTouches.length) {
          return;
        }
        touchEndX = event.changedTouches[0].clientX;
      },
      { passive: true }
    );

    slider.addEventListener(
      'touchend',
      function () {
        const delta = touchEndX - touchStartX;
        if (Math.abs(delta) > 35) {
          if (delta > 0) {
            showSlide(currentIndex - 1);
          } else {
            showSlide(currentIndex + 1);
          }
        }
        startSlider();
      },
      { passive: true }
    );

    slider.addEventListener('mouseenter', stopSlider);
    slider.addEventListener('mouseleave', startSlider);
    slider.addEventListener('focusin', stopSlider);
    slider.addEventListener('focusout', startSlider);

    showSlide(0);
    startSlider();
  }

  const feed = document.querySelector('[data-infinite-feed]');
  const feedMoreButton = document.querySelector('[data-feed-more]');
  const status = document.querySelector('[data-feed-status]');
  const revealCards = function (scope) {
    const root = scope || document;
    const cards = Array.from(root.querySelectorAll('.card'));

    if (!cards.length) {
      return;
    }

    if (!('IntersectionObserver' in window)) {
      cards.forEach(function (card) {
        card.classList.add('is-visible');
      });
      return;
    }

    const observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    );

    cards.forEach(function (card) {
      card.classList.add('news-reveal');
      observer.observe(card);
    });
  };

  revealCards(document);

  if (feed && feedMoreButton) {
    let page = parseInt(feed.getAttribute('data-page') || '1', 10);
    const maxPages = parseInt(feed.getAttribute('data-max-pages') || '1', 10);
    const exclude = feed.getAttribute('data-exclude') || '';
    let loading = false;
    let finished = page >= maxPages;

    const setStatus = function (text) {
      if (status) {
        status.textContent = text || '';
      }
    };

    const loadMore = function () {
      if (loading || finished) {
        return;
      }

      loading = true;
      page += 1;
      setStatus(millisferaTheme.feedLoading || 'Yüklənir...');
      feedMoreButton.disabled = true;
      feedMoreButton.textContent = millisferaTheme.feedLoading || 'Yüklənir...';

      const body = new URLSearchParams();
      body.set('action', 'millisfera_load_more_posts');
      body.set('nonce', millisferaTheme.nonce || '');
      body.set('page', String(page));
      body.set('exclude', exclude);

      fetch(millisferaTheme.ajaxUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        },
        body: body.toString(),
      })
        .then(function (res) {
          return res.json();
        })
        .then(function (json) {
          const html = json && json.success && json.data ? json.data.html : '';

          if (html) {
            const template = document.createElement('template');
            template.innerHTML = html.trim();
            const fragment = template.content;
            const newCards = Array.from(fragment.querySelectorAll('.card'));
            feed.appendChild(fragment);
            newCards.forEach(function (card) {
              card.classList.add('news-reveal');
            });
            window.requestAnimationFrame(function () {
              revealCards(feed);
            });
          }

          if (!html || page >= maxPages) {
            finished = true;
            feedMoreButton.remove();
            setStatus(millisferaTheme.feedEnd || 'Bütün xəbərlər göstərildi.');
          } else {
            setStatus('');
            feedMoreButton.disabled = false;
            feedMoreButton.textContent = millisferaTheme.feedMore || 'Daha çox';
          }
        })
        .catch(function () {
          finished = true;
          feedMoreButton.remove();
          setStatus('Yükləmə zamanı xəta baş verdi.');
        })
        .finally(function () {
          loading = false;
        });
    };

    feedMoreButton.addEventListener('click', loadMore);
  }

  const categoryCarousels = Array.from(document.querySelectorAll('[data-category-carousel]'));
  categoryCarousels.forEach(function (carousel) {
    const track = carousel.querySelector('[data-category-track]');
    if (!track) {
      return;
    }

    let timer = null;
    let isAnimating = false;
    const interval = Math.max(parseInt(carousel.getAttribute('data-interval') || '3200', 10), 1800);

    const getItems = function () {
      return Array.from(track.querySelectorAll('[data-category-item]'));
    };

    const step = function () {
      const items = getItems();
      if (items.length <= 3 || isAnimating) {
        return;
      }

      const first = items[0];
      const styles = window.getComputedStyle(track);
      const gap = parseFloat(styles.columnGap || styles.gap || '0') || 0;
      const distance = first.getBoundingClientRect().width + gap;

      isAnimating = true;
      track.classList.add('is-sliding');
      track.style.transform = 'translateX(-' + distance + 'px)';

      window.setTimeout(function () {
        track.classList.remove('is-sliding');
        track.appendChild(first);
        track.style.transform = 'translateX(0)';
        isAnimating = false;
      }, 620);
    };

    const start = function () {
      if (getItems().length <= 3) {
        return;
      }

      stop();
      timer = window.setInterval(step, interval);
    };

    const stop = function () {
      if (timer) {
        window.clearInterval(timer);
        timer = null;
      }
    };

    carousel.addEventListener('mouseenter', stop);
    carousel.addEventListener('mouseleave', start);
    carousel.addEventListener('focusin', stop);
    carousel.addEventListener('focusout', start);
    window.addEventListener('resize', function () {
      track.classList.remove('is-sliding');
      track.style.transform = 'translateX(0)';
    });

    start();
  });

  var fetchWeather = function (el, onSuccess, onError) {
    if (!millisferaTheme.weatherNonce) return;
    var city = el.getAttribute('data-city') || millisferaTheme.weatherCity || 'Baku,AZ';
    var url = new URL(millisferaTheme.ajaxUrl);
    url.searchParams.set('action', 'millisfera_weather');
    url.searchParams.set('nonce', millisferaTheme.weatherNonce);
    url.searchParams.set('city', city);
    fetch(url.toString(), { credentials: 'same-origin' })
      .then(function (res) { return res.json(); })
      .then(function (json) {
        var data = json && json.success ? json.data : null;
        if (!data || typeof data.temp !== 'number') throw new Error('unavailable');
        onSuccess(data);
      })
      .catch(onError);
  };

  var conditionClass = function (description) {
    var d = (description || '').toLowerCase();
    if (d.includes('rain')  || d.includes('drizzle')  || d.includes('shower') ||
        d.includes('yağış') || d.includes('çiskin'))                           return 'is-rain';
    if (d.includes('snow')  || d.includes('sleet')  ||
        d.includes('qar')   || d.includes('dolu'))                             return 'is-snow';
    if (d.includes('cloud') || d.includes('overcast') ||
        d.includes('bulud') || d.includes('qapalı'))                           return 'is-cloud';
    return 'is-sun';
  };

  const weatherRail = document.querySelector('[data-weather-rail]');
  if (weatherRail) {
    var weatherText = weatherRail.querySelector('[data-weather-rail-text]');
    fetchWeather(weatherRail,
      function (data) {
        weatherRail.classList.add('is-loaded');
        weatherRail.setAttribute('title', (data.description || 'Hava') + ' · ' + (data.updated || ''));
        if (weatherText) weatherText.textContent = (data.city || 'Bakı') + ' ' + data.temp + '°';
      },
      function () {
        weatherRail.classList.add('has-error');
        if (weatherText) weatherText.textContent = 'Hava --°';
      }
    );
  }

  const weatherSidebar = document.querySelector('[data-weather-sidebar]');
  if (weatherSidebar) {
    var swIcon    = weatherSidebar.querySelector('[data-sw-icon]');
    var swTemp    = weatherSidebar.querySelector('[data-sw-temp]');
    var swCity    = weatherSidebar.querySelector('[data-sw-city]');
    var swDesc    = weatherSidebar.querySelector('[data-sw-desc]');
    var swUpdated = weatherSidebar.querySelector('[data-sw-updated]');
    var swHumEl   = weatherSidebar.querySelector('[data-sw-humidity] span');
    var swWindEl  = weatherSidebar.querySelector('[data-sw-wind] span');
    var swFeelEl  = weatherSidebar.querySelector('[data-sw-feels] span');
    fetchWeather(weatherSidebar,
      function (data) {
        var cls = conditionClass(data.description || data.icon_code || '');
        weatherSidebar.classList.remove('is-sun', 'is-cloud', 'is-rain', 'is-snow');
        weatherSidebar.classList.add(cls);
        if (swIcon) {
          swIcon.classList.remove('is-sun', 'is-cloud', 'is-rain', 'is-snow');
          swIcon.classList.add(cls);
        }
        if (swTemp)    swTemp.textContent    = (data.temp !== null ? data.temp : '--') + '°';
        if (swCity)    swCity.textContent    = data.city || 'Bakı';
        if (swDesc)    swDesc.textContent    = data.description || '';
        if (swUpdated) swUpdated.textContent = data.updated ? 'Yeniləndi: ' + data.updated : '';
        if (swHumEl  && data.humidity  !== null) swHumEl.textContent  = data.humidity  + ' %';
        if (swWindEl && data.wind      !== null) swWindEl.textContent = data.wind      + ' km/s';
        if (swFeelEl && data.feels_like !== null) swFeelEl.textContent = data.feels_like + '°';
      },
      function () {
        if (swDesc) swDesc.textContent = 'Hava məlumatı alınmadı';
      }
    );
  }

  const weatherArchive = document.querySelector('[data-weather-archive]');
  if (weatherArchive) {
    var awIcon  = weatherArchive.querySelector('[data-aw-icon]');
    var awTemp  = weatherArchive.querySelector('[data-aw-temp]');
    var awDesc  = weatherArchive.querySelector('[data-aw-desc]');
    fetchWeather(weatherArchive,
      function (data) {
        if (awTemp) awTemp.textContent = data.temp + '°';
        if (awDesc) awDesc.textContent = (data.city || 'Bakı') + ' · ' + (data.description || '');
        if (awIcon) {
          awIcon.classList.remove('is-sun', 'is-cloud', 'is-rain', 'is-snow');
          awIcon.classList.add(conditionClass(data.description));
        }
        weatherArchive.setAttribute('title', (data.description || '') + ' · ' + (data.updated || ''));
      },
      function () {
        if (awTemp) awTemp.textContent = '--°';
        if (awDesc) awDesc.textContent = 'Bakı';
      }
    );
  }

  var investazWrap = document.getElementById('investaz-wrap');
  if (investazWrap) {
    var iazDarkCss  = {"hfc":"rgba(215,215,216,1)","rfc":"rgba(180,188,196,1)","hbgc":"rgba(18,26,31,1)","tbgc":"rgba(37,199,140,1)","bbgc":"rgba(18,26,31,1)","sbgc":"rgba(26,35,40,1)"};
    var iazLightCss = {"hfc":"rgba(17,17,17,1)","rfc":"rgba(95,99,104,1)","hbgc":"rgba(238,242,243,1)","tbgc":"rgba(0,167,111,1)","bbgc":"rgba(255,255,255,1)","sbgc":"rgba(224,230,233,1)"};
    var iazSymbols  = {"f":["EURUSD","GBPUSD","USDJPY","USDCAD","USDCHF","AUDUSD"],"i":["DOWJ","SP500","DAX","FTSE100"],"m":["XAUUSD","XAGUSD","XPDUSD","XPTUSD"],"e":["COTTON","SUGAR","NATG","OILUK"],"c":["BTCUSD","ETHUSD","LTCUSD","BCHUSD"],"s":["APPLE","AIG","CITIGROUP","BOEING"]};
    var currentInvestazTheme = null;

    var renderInvestaz = function (dark) {
      if (currentInvestazTheme === (dark ? 'dark' : 'light')) {
        return;
      }
      var oldScript = investazWrap.querySelector('[data-investaz-script]');
      if (oldScript) {
        oldScript.remove();
      }
      investazWrap.innerHTML = '<a href="https://www.investaz.az" target="_blank" rel="noopener" id="iazw_markets_tool">InvestAZ</a>';
      window.iazw_markets = {
        width: investazWrap.offsetWidth || 300,
        lang: 'az',
        id: 'iazw_markets_tool',
        css: dark ? iazDarkCss : iazLightCss,
        symbols: iazSymbols,
        theme: dark ? 'dark' : 'light'
      };
      var s = document.createElement('script');
      s.src = 'https://static.investaz.az/embed/tools/js/iazw-markets-v2.js?v=' + Date.now();
      s.setAttribute('data-investaz-script', 'true');
      investazWrap.appendChild(s);
      currentInvestazTheme = dark ? 'dark' : 'light';
    };

    var isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    renderInvestaz(isDark);

    new MutationObserver(function (mutations) {
      mutations.forEach(function (m) {
        if (m.attributeName === 'data-theme') {
          renderInvestaz(document.documentElement.getAttribute('data-theme') === 'dark');
        }
      });
    }).observe(document.documentElement, { attributes: true });
  }

  // ── Mobile Bottom Navbar ──
  var floatingRail    = document.querySelector('.floating-rail');
  var mbnSocialBtn    = document.querySelector('[data-mbn-social]');
  var mbnSearchBtn    = document.querySelector('[data-mbn-search]');
  var mbnCatsBtn      = document.querySelector('[data-mbn-cats]');
  var mbnCatsPanel    = document.querySelector('[data-mbn-cats-panel]');
  var mbnCatsClose    = document.querySelector('[data-mbn-cats-close]');
  var mbnOverlay      = document.querySelector('[data-mbn-overlay]');

  var closeMbnAll = function () {
    if (floatingRail)  { floatingRail.classList.remove('mbn-social-open'); }
    if (mbnCatsPanel)  { mbnCatsPanel.classList.remove('is-open'); mbnCatsPanel.setAttribute('aria-hidden', 'true'); }
    if (mbnOverlay)    { mbnOverlay.classList.remove('is-open'); }
    if (mbnSocialBtn)  { mbnSocialBtn.classList.remove('is-active'); mbnSocialBtn.setAttribute('aria-expanded', 'false'); }
    if (mbnCatsBtn)    { mbnCatsBtn.classList.remove('is-active'); mbnCatsBtn.setAttribute('aria-expanded', 'false'); }
  };

  if (mbnSocialBtn && floatingRail) {
    mbnSocialBtn.addEventListener('click', function () {
      var isOpen = floatingRail.classList.contains('mbn-social-open');
      closeMbnAll();
      if (!isOpen) {
        floatingRail.classList.add('mbn-social-open');
        mbnSocialBtn.classList.add('is-active');
        mbnSocialBtn.setAttribute('aria-expanded', 'true');
        if (mbnOverlay) mbnOverlay.classList.add('is-open');
      }
    });
  }

  if (mbnCatsBtn && mbnCatsPanel) {
    mbnCatsBtn.addEventListener('click', function () {
      var isOpen = mbnCatsPanel.classList.contains('is-open');
      closeMbnAll();
      if (!isOpen) {
        mbnCatsPanel.classList.add('is-open');
        mbnCatsPanel.setAttribute('aria-hidden', 'false');
        mbnCatsBtn.classList.add('is-active');
        mbnCatsBtn.setAttribute('aria-expanded', 'true');
        if (mbnOverlay) mbnOverlay.classList.add('is-open');
      }
    });
  }

  if (mbnCatsClose) {
    mbnCatsClose.addEventListener('click', closeMbnAll);
  }

  if (mbnOverlay) {
    mbnOverlay.addEventListener('click', closeMbnAll);
  }

  if (mbnSearchBtn) {
    mbnSearchBtn.addEventListener('click', function () {
      closeMbnAll();
      var searchToggle = document.querySelector('[data-search-toggle]');
      if (searchToggle) searchToggle.click();
    });
  }

  var scrollControl = document.querySelector('[data-scroll-control]');
  var scrollControlText = document.querySelector('[data-scroll-control-text]');

  if (scrollControl) {
    var setScrollControlState = function () {
      var scrollTop = window.scrollY || document.documentElement.scrollTop || document.body.scrollTop || 0;
      var maxScroll = Math.max(
        document.documentElement.scrollHeight - document.documentElement.clientHeight,
        0
      );
      var progressValue = maxScroll > 0 ? Math.min((scrollTop / maxScroll) * 360, 360) : 0;
      var isUpMode = scrollTop > Math.max(160, window.innerHeight * 0.35);
      var isScrollable = maxScroll > 24;

      scrollControl.classList.toggle('is-hidden', !isScrollable);
      scrollControl.classList.toggle('is-up', isUpMode);
      scrollControl.classList.toggle('is-down', !isUpMode);
      scrollControl.style.setProperty('--scroll-progress', progressValue + 'deg');
      scrollControl.setAttribute('aria-label', isUpMode ? 'Yuxarı qalx' : 'Aşağı düş');
      scrollControl.setAttribute('title', isUpMode ? 'Yuxarı qalx' : 'Aşağı düş');

      if (scrollControlText) {
        scrollControlText.textContent = isUpMode ? 'Yuxarı' : 'Aşağı';
      }
    };

    scrollControl.addEventListener('click', function () {
      var isUpMode = scrollControl.classList.contains('is-up');
      var scrollTop = window.scrollY || document.documentElement.scrollTop || document.body.scrollTop || 0;
      var maxScroll = Math.max(
        document.documentElement.scrollHeight - document.documentElement.clientHeight,
        0
      );
      var footer = document.querySelector('.site-footer');
      var footerTop = footer ? footer.getBoundingClientRect().top + scrollTop : maxScroll;
      var target = isUpMode ? 0 : Math.min(footerTop, maxScroll);

      scrollControl.classList.remove('is-bursting');
      void scrollControl.offsetWidth;
      scrollControl.classList.add('is-bursting');
      window.setTimeout(function () {
        scrollControl.classList.remove('is-bursting');
      }, 620);

      window.scrollTo({
        top: target,
        behavior: 'smooth'
      });
    });

    document.addEventListener('scroll', setScrollControlState, { passive: true });
    window.addEventListener('resize', setScrollControlState);
    setScrollControlState();
  }

  if (progress) {
    const updateProgress = function () {
      const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const value = scrollHeight > 0 ? (scrollTop / scrollHeight) * 100 : 0;
      progress.style.width = value + '%';
    };

    document.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();
  }
})();
