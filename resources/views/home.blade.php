<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&amp;family=Cairo:wght@700;900&amp;family=Inter:wght@400;500;600&amp;family=Plus+Jakarta+Sans:wght@700;800&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
    rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          "colors": {
            "surface-tint": "#5D318C",
            "background": "#f6fafe",
            "inverse-on-surface": "#edf1f5",
            "error": "#ba1a1a",
            "surface-container-lowest": "#ffffff",
            "primary-fixed": "#efdbff",
            "primary-container": "#5d318c",
            "on-error": "#ffffff",
            "on-surface": "#171c1f",
            "surface-variant": "#dfe3e7",
            "on-tertiary": "#ffffff",
            "outline": "#757682",
            "on-secondary-container": "#572000",
            "on-tertiary-fixed": "#001e2d",
            "on-secondary-fixed": "#351000",
            "on-tertiary-container": "#009ad3",
            "on-error-container": "#93000a",
            "secondary-fixed-dim": "#ffb693",
            "surface-container-low": "#f0f4f8",
            "surface-container-highest": "#dfe3e7",
            "surface-container": "#eaeef2",
            "tertiary-fixed": "#c6e7ff",
            "secondary": "#FF4E00",
            "error-container": "#ffdad6",
            "outline-variant": "#c5c6d2",
            "on-secondary": "#ffffff",
            "primary": "#5D318C",
            "tertiary": "#001623",
            "on-secondary-fixed-variant": "#7a3000",
            "inverse-surface": "#2c3134",
            "primary-fixed-dim": "#dbb8ff",
            "on-tertiary-fixed-variant": "#004c6b",
            "on-primary-fixed-variant": "#5c308b",
            "surface-dim": "#d6dade",
            "on-primary-fixed": "#2b0052",
            "secondary-fixed": "#ffdbcc",
            "surface": "#ffffff",
            "on-primary": "#ffffff",
            "surface-container-high": "#e4e9ed",
            "surface-bright": "#ffffff",
            "inverse-primary": "#dbb8ff",
            "tertiary-fixed-dim": "#81cfff",
            "on-primary-container": "#dbb8ff",
            "tertiary-container": "#002c40",
            "secondary-container": "#FF4E00",
            "on-surface-variant": "#444650",
            "on-background": "#171c1f"
          },
          "borderRadius": {
            "DEFAULT": "0.25rem",
            "lg": "0.5rem",
            "xl": "0.75rem",
            "full": "9999px"
          },
          "spacing": {},
          "fontFamily": {
            "headline": ["Plus Jakarta Sans"],
            "body": ["Inter"],
            "label": ["Inter"],
            "montserrat": ["Montserrat"],
            "cairo": ["Cairo"]
          }
        },
      },
    }
  </script>
  <style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
    }

    .signature-gradient {
      background: linear-gradient(135deg, #5D318C 0%, #3a1e58 100%);
    }

    .hero-gradient-overlay {
      background: linear-gradient(180deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
    }

    .vibrant-orange-accent {
      background: linear-gradient(135deg, #FF4E00 0%, #FF7C32 100%);
    }

    .purple-glow-overlay {
      background: linear-gradient(135deg, rgba(93, 49, 140, 0.05) 0%, rgba(255, 78, 0, 0.02) 100%);
    }
  </style>
</head>

<body class="bg-white text-on-surface font-body selection:bg-primary-container/30">
  <!-- TopNavBar -->
  <nav class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-xl shadow-sm">
    <div class="flex flex-row justify-between items-center w-full px-8 py-4 max-w-8xl mx-auto">
      <div class="flex items-center gap-8">
        <a class="text-2xl font-black tracking-tighter text-primary" href="#">Digi Business</a>
        <div class="hidden md:flex gap-6 items-center">
          <a class="font-montserrat text-sm font-bold uppercase tracking-wider text-primary border-b-2 border-primary pb-1"
            href="#">Services</a>
          <a class="font-montserrat text-sm font-bold uppercase tracking-wider text-on-surface-variant/80 hover:text-primary transition-colors"
            href="#">Solutions</a>
          <a class="font-montserrat text-sm font-bold uppercase tracking-wider text-on-surface-variant/80 hover:text-primary transition-colors"
            href="#">Pricing</a>
          <a class="font-montserrat text-sm font-bold uppercase tracking-wider text-on-surface-variant/80 hover:text-primary transition-colors"
            href="#">About Us</a>
          <a class="font-montserrat text-sm font-bold uppercase tracking-wider text-on-surface-variant/80 hover:text-primary transition-colors"
            href="#">Contact</a>
        </div>
      </div>
      <div class="flex items-center gap-4">
        <button
          class="text-on-surface-variant text-sm font-bold font-montserrat uppercase tracking-wider hover:text-primary transition-all">العربية</button>
        <button
          class="signature-gradient text-white px-6 py-2.5 rounded-xl font-bold text-sm tracking-wide shadow-lg shadow-primary/20 active:scale-95 transition-transform">Get
          Started</button>
      </div>
    </div>
  </nav>
  <main class="pt-20">
    <!-- Hero Section -->
    <section class="relative min-h-[921px] flex items-center overflow-hidden px-8">
      <div class="absolute inset-0 z-0">
        <img alt="Modern corporate office interior" class="w-full h-full object-cover opacity-15"
          data-alt="Modern high-end corporate office interior in Riyadh with glass walls and professional lighting during sunset"
          src="https://lh3.googleusercontent.com/aida-public/AB6AXuAJLGjfgNR9-MvNy57dmEj38mJ8MhtCMUzT0bZThUPn-xKmA7FL_kH_ylCvBqPEJGMpQqPbH1AGYmgX6pEqNOIrcgewPx5afvf9xY7ZyDPYxneeY-ZYj_KqngFYUU0JEv8RwhNLA14AckTVTqG-aE2FNLFe2GE4T4TlGq6gTBHng6UKNG3yDziphE8bQ7swJlZd-tixwzr2uHNXNsgoOr_8OEec1YtgSDoQwZfd3CArdTTFpxHYIvB6h0RNmiaxl6op0B7VU6_-IzM" />
        <div class="hero-gradient-overlay absolute inset-0"></div>
      </div>
      <div class="relative z-10 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <span
            class="inline-block bg-secondary/10 text-secondary font-bold text-xs uppercase tracking-widest px-3 py-1 rounded-full mb-6">Sovereign
            Kinetic Solutions</span>
          <h1 class="text-primary font-montserrat font-black text-5xl md:text-7xl leading-tight tracking-tighter mb-8">
            Your Strategic Partner for Digital Growth in the Kingdom and Gulf.
          </h1>
          <p class="text-on-surface-variant text-xl md:text-2xl max-w-xl leading-relaxed mb-10">
            Integrated B2B solutions for Marketing, Web Dev, and Business Consultancy. Tailored for the modern
            landscape.
          </p>
          <div class="flex flex-wrap gap-4">
            <button
              class="signature-gradient text-white px-10 py-4 rounded-xl font-bold text-lg shadow-xl shadow-primary/20 flex items-center gap-2 group">
              Start Your Journey
              <span
                class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </button>
            <button
              class="bg-surface-container-highest/50 backdrop-blur-md text-primary border border-outline-variant/20 px-10 py-4 rounded-xl font-bold text-lg hover:bg-surface-container-highest transition-all">
              View Case Studies
            </button>
          </div>
        </div>
        <div class="hidden lg:block relative">
          <div class="glass-card p-8 rounded-[2rem] border border-white/40 shadow-2xl relative z-20">
            <div class="grid grid-cols-2 gap-4">
              <div class="bg-white p-6 rounded-2xl shadow-sm border border-outline-variant/5">
                <span class="material-symbols-outlined text-secondary text-4xl mb-4"
                  data-icon="rocket_launch">rocket_launch</span>
                <h3 class="font-bold text-primary text-lg mb-2">Growth Acceleration</h3>
                <p class="text-sm text-on-surface-variant">Strategic roadmaps for local markets.</p>
              </div>
              <div class="bg-primary p-6 rounded-2xl shadow-sm text-white">
                <span class="material-symbols-outlined text-secondary-fixed-dim text-4xl mb-4"
                  data-icon="bar_chart">bar_chart</span>
                <h3 class="font-bold text-lg mb-2">Data Insights</h3>
                <p class="text-sm opacity-80">Precision analytics for Gulf enterprises.</p>
              </div>
              <div class="col-span-2 vibrant-orange-accent p-6 rounded-2xl shadow-sm text-white">
                <div class="flex justify-between items-center">
                  <div>
                    <h3 class="font-bold text-xl mb-1 text-white">Market Dominance</h3>
                    <p class="text-sm opacity-90 text-white/90">Achieve sustainable competitive advantage.</p>
                  </div>
                  <span class="material-symbols-outlined text-5xl text-white" data-icon="star" data-weight="fill"
                    style="font-variation-settings: 'FILL' 1;">star</span>
                </div>
              </div>
            </div>
          </div>
          <!-- Decorative Element -->
          <div class="absolute -top-12 -right-12 w-64 h-64 bg-secondary/10 rounded-full blur-3xl -z-10"></div>
          <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-primary/10 rounded-full blur-3xl -z-10"></div>
        </div>
      </div>
    </section>
    <!-- About Us Summary -->
    <section class="py-24 bg-surface-container-low/30">
      <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-12 gap-16 items-center">
        <div class="md:col-span-5 relative">
          <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
            <img alt="Professional team meeting" class="w-full h-[500px] object-cover"
              data-alt="Diverse business team collaborating in a sleek modern boardroom with digital displays and natural light"
              src="https://lh3.googleusercontent.com/aida-public/AB6AXuAiuJG-zU2uYQ-YrsPRPs2zrsvgvHVvscgn_qUGo13Yc6UO7iu4hp7sGhfqvhaZ6Sk0BkyFC_feG5OcdzzdbIGpIBbPqpsrcelEBsjyr-SnlNg-JeNTnnb5E-D-QyuhUe1ynPfQDd-AUcBK0NtI8A5PkLg3ABA5jSYX3uKTHFnJGNmlaUkpQqUsWJVUfHQ9VTt-zpKj9OWC7HB4f8brUnNVRJwDi6PHcbdGn-fajGg4VfzpD7D9PKn-DoWoc3QZxzk-TltD2CTTZSU" />
          </div>
          <div
            class="absolute -bottom-8 -right-8 glass-card p-6 rounded-2xl border border-white/50 shadow-xl max-w-[240px]">
            <p class="text-primary font-black text-4xl mb-1">15+</p>
            <p class="text-on-surface-variant text-sm font-semibold uppercase tracking-wider leading-tight">Years of
              Regional Excellence</p>
          </div>
        </div>
        <div class="md:col-span-7">
          <h4 class="text-secondary font-bold text-sm uppercase tracking-[0.2em] mb-4">Our Legacy</h4>
          <h2 class="text-primary font-montserrat font-black text-4xl md:text-5xl leading-tight mb-8">Elevating Business
            Standards Across the Kingdom.</h2>
          <p class="text-on-surface-variant text-lg leading-relaxed mb-8">
            Digi Business isn't just a consultancy; we are an architectural force in the digital ecosystem of the Middle
            East. We specialize in transforming established businesses and ambitious startups into digital leaders by
            blending global innovation with deep local cultural insights.
          </p>
          <div class="grid grid-cols-2 gap-8 mb-10">
            <div class="border-l-4 border-secondary pl-4">
              <h5 class="font-bold text-primary mb-1">Vision 2030 Aligned</h5>
              <p class="text-sm text-on-surface-variant">Supporting the Kingdom's economic diversification goals.</p>
            </div>
            <div class="border-l-4 border-primary pl-4">
              <h5 class="font-bold text-primary mb-1">Regional Network</h5>
              <p class="text-sm text-on-surface-variant">Global reach with offices in Riyadh, Dubai, and Kuwait.</p>
            </div>
          </div>
          <a class="text-primary font-bold flex items-center gap-2 hover:gap-4 transition-all" href="#">
            Learn More About Our Mission
            <span class="material-symbols-outlined">arrow_forward</span>
          </a>
        </div>
      </div>
    </section>
    <!-- Core Services Grid (Bento Style Updated) -->
    <section class="py-24 px-8 max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <h2 class="text-primary font-montserrat font-black text-4xl md:text-5xl mb-6">Core Strategic Services</h2>
        <p class="text-on-surface-variant text-lg max-w-2xl mx-auto">Precision-engineered solutions designed to scale
          your enterprise.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-6 lg:grid-cols-12 gap-6 auto-rows-[280px]">
        <!-- 1. Web & App Development -->
        <div
          class="md:col-span-3 lg:col-span-4 row-span-2 glass-card p-8 rounded-[2.5rem] border border-white/60 shadow-xl flex flex-col justify-between group hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 relative overflow-hidden">
          <div
            class="absolute -top-10 -right-10 w-40 h-40 vibrant-orange-accent opacity-10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700">
          </div>
          <div class="relative z-10">
            <div
              class="vibrant-orange-accent w-16 h-16 rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-secondary/20">
              <span class="material-symbols-outlined text-white text-3xl" data-icon="devices">devices</span>
            </div>
            <h3 class="text-primary font-black text-2xl mb-4 leading-tight">Web &amp; App<br />Development</h3>
            <p class="text-on-surface-variant text-base leading-relaxed">High-performance digital products engineered
              for scalability and seamless user experience.</p>
          </div>
          <div class="relative z-10 flex justify-between items-center mt-6">
            <span class="text-secondary font-bold text-xs uppercase tracking-widest">Tech Excellence</span>
            <span class="material-symbols-outlined text-secondary group-hover:translate-x-1 transition-transform"
              data-icon="arrow_right_alt">arrow_right_alt</span>
          </div>
        </div>
        <!-- 2. Digital Marketing -->
        <div
          class="md:col-span-3 lg:col-span-8 row-span-1 glass-card p-8 rounded-[2.5rem] border border-white/60 shadow-xl flex items-center gap-8 group hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
          <div
            class="vibrant-orange-accent w-20 h-20 shrink-0 rounded-3xl flex items-center justify-center shadow-xl shadow-secondary/20">
            <span class="material-symbols-outlined text-white text-4xl" data-icon="ads_click">ads_click</span>
          </div>
          <div class="flex-1">
            <h3 class="text-primary font-black text-2xl mb-2">Digital Marketing</h3>
            <p class="text-on-surface-variant text-base line-clamp-2">Precision-targeted campaigns and growth hacking
              strategies that dominate regional market share.</p>
          </div>
          <span class="material-symbols-outlined text-secondary text-3xl group-hover:rotate-45 transition-transform"
            data-icon="north_east">north_east</span>
        </div>
        <!-- 3. Branding -->
        <div
          class="md:col-span-3 lg:col-span-4 row-span-1 glass-card p-8 rounded-[2.5rem] border border-white/60 shadow-xl flex flex-col justify-center group hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 relative overflow-hidden">
          <div class="absolute inset-0 bg-primary/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-xl border-2 border-secondary flex items-center justify-center">
              <span class="material-symbols-outlined text-secondary text-2xl" data-icon="palette">palette</span>
            </div>
            <h3 class="text-primary font-black text-xl">Branding</h3>
          </div>
          <p class="text-on-surface-variant text-sm">Visual identities that command respect and resonate with Gulf
            heritage.</p>
        </div>
        <!-- 4. Content Creation -->
        <div
          class="md:col-span-3 lg:col-span-4 row-span-1 glass-card p-8 rounded-[2.5rem] border border-white/60 shadow-xl flex flex-col justify-center group hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
          <div class="flex items-center gap-4 mb-4">
            <div
              class="w-12 h-12 rounded-xl vibrant-orange-accent flex items-center justify-center shadow-lg shadow-secondary/20">
              <span class="material-symbols-outlined text-white text-2xl" data-icon="video_library">video_library</span>
            </div>
            <h3 class="text-primary font-black text-xl">Content Creation</h3>
          </div>
          <p class="text-on-surface-variant text-sm">Multilingual storytelling and high-impact media production for
            modern platforms.</p>
        </div>
        <!-- 5. Business Consultancy -->
        <div
          class="md:col-span-6 lg:col-span-8 row-span-1 bg-primary p-8 rounded-[2.5rem] text-white flex items-center justify-between group hover:shadow-2xl transition-all duration-500 relative overflow-hidden">
          <div class="absolute right-0 top-0 w-1/2 h-full bg-white/10 skew-x-12 translate-x-1/4"></div>
          <div class="relative z-10 max-w-md">
            <div class="bg-white/10 w-14 h-14 rounded-xl flex items-center justify-center mb-4 backdrop-blur-md">
              <span class="material-symbols-outlined text-white text-3xl" data-icon="query_stats">query_stats</span>
            </div>
            <h3 class="font-black text-2xl mb-2 text-white">Business Consultancy</h3>
            <p class="text-white/70 text-base">Strategic market entry and operational optimization for the Kingdom's
              evolving landscape.</p>
          </div>
          <button
            class="relative z-10 bg-white text-primary px-8 py-3 rounded-xl font-bold hover:bg-secondary hover:text-white transition-all active:scale-95">Consult
            Now</button>
        </div>
      </div>
    </section>
    <!-- Why Choose Us (Asymmetric) -->
    <section class="py-24 relative overflow-hidden bg-white">
      <div class="max-w-7xl mx-auto px-8">
        <div class="flex flex-col lg:flex-row gap-20">
          <div class="lg:w-1/3">
            <h2 class="text-primary font-montserrat font-black text-4xl md:text-5xl mb-8">The Sovereign Advantage.</h2>
            <p class="text-on-surface-variant text-lg mb-12">We don't just provide services; we provide a competitive
              edge defined by three core pillars.</p>
            <div class="space-y-6">
              <div class="p-6 bg-surface-container-low/50 rounded-2xl shadow-sm border-l-8 border-primary">
                <h4 class="font-bold text-primary text-xl mb-2">Regional Fluency</h4>
                <p class="text-on-surface-variant">Unmatched understanding of cultural nuances and market dynamics in
                  Saudi Arabia and the Gulf.</p>
              </div>
              <div class="p-6 bg-surface-container-low/50 rounded-2xl shadow-sm border-l-8 border-secondary">
                <h4 class="font-bold text-primary text-xl mb-2">High-Trust Integrity</h4>
                <p class="text-on-surface-variant">A commitment to transparency and results-driven metrics that senior
                  executives rely on.</p>
              </div>
            </div>
          </div>
          <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-8 pt-12">
            <div class="relative group">
              <div
                class="absolute inset-0 bg-primary rounded-[2rem] rotate-3 group-hover:rotate-0 transition-transform duration-500">
              </div>
              <div class="relative bg-white p-10 rounded-[2rem] h-full shadow-xl border border-outline-variant/10">
                <h3 class="font-black text-5xl text-primary mb-4 opacity-20">01</h3>
                <h4 class="font-bold text-2xl text-primary mb-4">Unrivaled Scalability</h4>
                <p class="text-on-surface-variant">Our solutions are built to grow from local champions to global
                  conglomerates without structural friction.</p>
              </div>
            </div>
            <div class="relative group mt-8 md:mt-16">
              <div
                class="absolute inset-0 bg-secondary rounded-[2rem] -rotate-3 group-hover:rotate-0 transition-transform duration-500">
              </div>
              <div class="relative bg-white p-10 rounded-[2rem] h-full shadow-xl border border-outline-variant/10">
                <h3 class="font-black text-5xl text-secondary mb-4 opacity-20">02</h3>
                <h4 class="font-bold text-2xl text-primary mb-4">Elite Tech Ecosystem</h4>
                <p class="text-on-surface-variant">Leveraging the latest in AI and predictive analytics to give our
                  partners a future-proof foundation.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- CTA Section -->
    <section class="py-20 px-8">
      <div
        class="max-w-7xl mx-auto signature-gradient rounded-[3rem] p-12 md:p-24 text-center relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-secondary/10 rounded-full blur-3xl -ml-48 -mb-48"></div>
        <h2 class="relative z-10 text-white font-montserrat font-black text-4xl md:text-6xl mb-8">Ready to Architect
          Your Future?</h2>
        <p class="relative z-10 text-white/70 text-xl md:text-2xl max-w-2xl mx-auto mb-12">Let's discuss how Digi
          Business can transform your regional footprint and digital capability.</p>
        <div class="relative z-10 flex flex-wrap justify-center gap-6">
          <button
            class="bg-secondary text-white px-12 py-5 rounded-2xl font-bold text-xl shadow-2xl shadow-secondary/20 hover:scale-105 active:scale-95 transition-all">Schedule
            a Consultation</button>
          <button
            class="bg-white/10 backdrop-blur-md text-white border border-white/20 px-12 py-5 rounded-2xl font-bold text-xl hover:bg-white/20 transition-all">Contact
            Our Riyadh Office</button>
        </div>
      </div>
    </section>
  </main>
  <!-- Footer -->
  <footer class="bg-white pt-16 pb-8 border-t border-outline-variant/10">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-12 px-8 md:px-16 max-w-7xl mx-auto text-right">
      <div class="text-left">
        <span class="text-xl font-bold text-primary mb-4 block">Digi Business</span>
        <p class="text-on-surface-variant/80 text-sm leading-relaxed mb-6">Redefining the digital frontier of the Gulf
          through strategic excellence and innovation.</p>
        <div class="flex gap-4">
          <span class="material-symbols-outlined text-primary hover:text-secondary cursor-pointer"
            data-icon="public">public</span>
          <span class="material-symbols-outlined text-primary hover:text-secondary cursor-pointer"
            data-icon="mail">mail</span>
        </div>
      </div>
      <div>
        <h4 class="font-bold text-primary mb-6">Expertise</h4>
        <ul class="space-y-4">
          <li><a class="text-on-surface-variant/80 hover:text-primary transition-colors text-sm" href="#">Web &amp; App
              Development</a></li>
          <li><a class="text-on-surface-variant/80 hover:text-primary transition-colors text-sm" href="#">Digital
              Marketing</a></li>
          <li><a class="text-on-surface-variant/80 hover:text-primary transition-colors text-sm" href="#">Branding</a>
          </li>
          <li><a class="text-on-surface-variant/80 hover:text-primary transition-colors text-sm" href="#">Content
              Creation</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold text-primary mb-6">Resources</h4>
        <ul class="space-y-4">
          <li><a class="text-on-surface-variant/80 hover:text-primary transition-colors text-sm" href="#">Saudi Vision
              2030</a></li>
          <li><a class="text-on-surface-variant/80 hover:text-primary transition-colors text-sm" href="#">Investor
              Relations</a></li>
          <li><a class="text-on-surface-variant/80 hover:text-primary transition-colors text-sm" href="#">Case
              Studies</a></li>
          <li><a class="text-on-surface-variant/80 hover:text-primary transition-colors text-sm" href="#">Contact
              Support</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold text-primary mb-6">Legal</h4>
        <ul class="space-y-4">
          <li><a class="text-on-surface-variant/80 hover:text-primary transition-colors text-sm" href="#">Privacy
              Policy</a></li>
          <li><a class="text-on-surface-variant/80 hover:text-primary transition-colors text-sm" href="#">Terms of
              Service</a></li>
          <li><a class="text-on-surface-variant/80 hover:text-primary transition-colors text-sm" href="#">Compliance</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="mt-16 pt-8 border-t border-outline-variant/5 text-center px-8">
      <p class="text-on-surface-variant/60 text-xs">© 2024 Digi Business. All rights reserved. Headquarters: Riyadh,
        KSA.</p>
    </div>
  </footer>
</body>

</html>