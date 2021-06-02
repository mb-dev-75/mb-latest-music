jQuery(function ($) {
  // css variables (colors)
  var main = getComputedStyle(document.documentElement).getPropertyValue(
      '--main'
    ),
    main_30 = getComputedStyle(document.documentElement).getPropertyValue(
      '--main-30'
    ),
    wave = getComputedStyle(document.documentElement).getPropertyValue(
      '--wave'
    ),
    wave_50 = getComputedStyle(document.documentElement).getPropertyValue(
      '--wave-50'
    ),
    wave_20 = getComputedStyle(document.documentElement).getPropertyValue(
      '--wave-20'
    );

  // ctx
  var ctx = document.createElement('canvas').getContext('2d');

  // Wave gradient
  var wave_gradient = ctx.createLinearGradient(0, 0, 0, 250);
  wave_gradient.addColorStop(0, wave);
  wave_gradient.addColorStop(0.25, wave);
  wave_gradient.addColorStop(0.5, wave);
  wave_gradient.addColorStop(0.5, 'transparent');
  wave_gradient.addColorStop(0.51, wave_50);
  wave_gradient.addColorStop(0.7, wave_20);
  wave_gradient.addColorStop(0.85, 'transparent');
  wave_gradient.addColorStop(1, 'transparent');

  // Progress gradient
  var progress_gradient = ctx.createLinearGradient(0, 0, 0, 250);
  progress_gradient.addColorStop(0, main);
  progress_gradient.addColorStop(0.25, main);
  progress_gradient.addColorStop(0.5, main);
  progress_gradient.addColorStop(0.5, 'transparent');
  progress_gradient.addColorStop(0.51, main_30);
  progress_gradient.addColorStop(0.7, main_30);
  progress_gradient.addColorStop(0.85, 'transparent');
  progress_gradient.addColorStop(1, 'transparent');

  // Set params
  var wavesurfer = WaveSurfer.create({
    container: document.querySelector('#waveform'),
    waveColor: wave_gradient,
    progressColor: progress_gradient,
    cursorColor: main,
    cursorWidth: 0,
    barWidth: 1,
    barHeight: 1,
    barGap: null,
    height: 250,
    backend: 'MediaElement',
    mediaType: 'audio',
    mediaControls: false,
    normalize: true,
    hideScrollbar: true,
    responsive: true,
    fillParent: true,
  });

  // Set song
  wavesurfer.load(url);

  // Set peaks
  wavesurfer.backend.peaks = [
    0.0218, 0.0183, 0.0165, 0.0198, 0.2137, 0.2888, 0.2313, 0.15, 0.2542,
    0.2538, 0.2358, 0.1195, 0.1591, 0.2599, 0.2742, 0.1447, 0.2328, 0.1878,
    0.1988, 0.1645, 0.1218, 0.2005, 0.2828, 0.2051, 0.1664, 0.1181, 0.1621,
    0.2966, 0.189, 0.246, 0.2445, 0.1621, 0.1618, 0.189, 0.2354, 0.1561, 0.1638,
    0.2799, 0.0923, 0.1659, 0.1675, 0.1268, 0.0984, 0.0997, 0.1248, 0.1495,
    0.1431, 0.1236, 0.1755, 0.1183, 0.1349, 0.1018, 0.1109, 0.1833, 0.1813,
    0.1422, 0.0961, 0.1191, 0.0791, 0.0631, 0.0315, 0.0157, 0.0166, 0.0108,
  ];

  // Draw peaks
  wavesurfer.drawBuffer();

  // Format time
  var formatTime = function (time) {
    return [
      Math.floor((time % 3600) / 60), // minutes
      ('00' + Math.floor(time % 60)).slice(-2), // seconds
    ].join(':');
  };

  // Show current time
  wavesurfer.on('audioprocess', function () {
    $('.waveform__counter').text(formatTime(wavesurfer.getCurrentTime()));
  });

  // Show clip duration
  wavesurfer.on('ready', function () {
    $('.waveform__duration').text(formatTime(wavesurfer.getDuration()));
  });

  // Play button click
  play = document.querySelector('.svg-button');

  // When I click on play button
  play.addEventListener('click', function () {
    wavesurfer.backend.ac.resume().then(() => {
      wavesurfer.playPause();
      play.classList.toggle('flip');
      $('.waveform__duration').css('visibility', 'visible');
    });
  });

  // When song is finished
  wavesurfer.on('finish', function () {
    wavesurfer.stop();
    play.classList.toggle('flip');
    $('.waveform__counter').text('');
    $('.waveform__duration').css('visibility', 'hidden');
  });

  // When I click on the wave
  wavesurfer.drawer.on('click', function () {
    if (wavesurfer.isPlaying()) {
      wavesurfer.play();
    } else {
      wavesurfer.play();
      play.classList.toggle('flip');
      $('.waveform__duration').css('visibility', 'visible');
    }
  });
});
