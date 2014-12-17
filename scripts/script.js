Modernizr.load({
       test: Modernizr.mq('only all'),
       nope: '//cdn.jsdelivr.net/respond/1.2.0/respond.min.js'
});

yepnope({
  test : Modernizr.input.placeholder,
  nope : [
	 '//cdn.jsdelivr.net/placeholder-shiv/0.2/placeholder-shiv.jquery.js'
  ]
});
