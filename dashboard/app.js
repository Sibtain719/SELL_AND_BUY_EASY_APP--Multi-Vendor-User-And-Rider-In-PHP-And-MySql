const { useSprings, interpolate, useTransition, animated, useSpring } = ReactSpring;
const { useGesture } = ReactUseGesture;
const cx = classNames;

const pages = [
  {
    id: 1,
    title: 'Magic of Photo',
    date: 'Nov 20th 2020',
    place: 'Kyiv, Ukraine',
    video: 'https://player.vimeo.com/external/387172534.sd.mp4?s=fb4985189e9acf6520ba02ffd085812cf0dade97&profile_id=165&oauth2_token_id=57447761',
    poster: 'https://images.pexels.com/videos/3627139/free-video-3627139.jpg?auto=compress&cs=tinysrgb&dpr=1&w=500',
    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean hendrerit bibendum massa, at sollicitudin augue suscipit dictum. Aliquam euismod gravida ex, eu rutrum est dictum quis. Cras quis facilisis quam. Vestibulum vestibulum augue enim, ut sollicitudin nibh faucibus eu. Vivamus volutpat enim nisl, non tincidunt urna sodales feugiat. Etiam egestas interdum justo eget dignissim. Nulla facilisi. Etiam sagittis neque euismod iaculis accumsan. Nullam laoreet enim ligula. Maecenas sed risus mollis, aliquet odio et, convallis sem. Pellentesque venenatis, dui non pulvinar sodales, ipsum tellus tincidunt nisl, vel commodo arcu velit eget nulla. Integer eu facilisis est, vitae vehicula eros. Sed magna dui, accumsan sit amet mi a, rutrum lobortis lacus. Morbi efficitur massa ac sem aliquam maximus. Nullam libero purus, mollis vitae dolor non, posuere commodo lacus. Aenean lobortis augue nec molestie posuere. Praesent non massa ultricies, placerat magna lobortis, porta enim. Nulla dictum odio magna, et tempus velit luctus pharetra. Ut quis eros ut magna egestas vestibulum eget sit amet urna. Maecenas euismod lectus ut enim pretium mollis. Praesent tellus tellus, tincidunt a velit non, varius semper nisi.',
  },
  {
    id: 2,
    title: 'Rock Fest',
    date: 'Jan 24th 2017',
    place: 'Kharkiv, Ukraine',
    image: 'https://images.pexels.com/photos/164693/pexels-photo-164693.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean hendrerit bibendum massa, at sollicitudin augue suscipit dictum. Aliquam euismod gravida ex, eu rutrum est dictum quis. Cras quis facilisis quam. Vestibulum vestibulum augue enim, ut sollicitudin nibh faucibus eu. Vivamus volutpat enim nisl, non tincidunt urna sodales feugiat. Etiam egestas interdum justo eget dignissim. Nulla facilisi. Etiam sagittis neque euismod iaculis accumsan. Nullam laoreet enim ligula. Maecenas sed risus mollis, aliquet odio et, convallis sem. Pellentesque venenatis, dui non pulvinar sodales, ipsum tellus tincidunt nisl, vel commodo arcu velit eget nulla. Integer eu facilisis est, vitae vehicula eros. Sed magna dui, accumsan sit amet mi a, rutrum lobortis lacus. Morbi efficitur massa ac sem aliquam maximus. Nullam libero purus, mollis vitae dolor non, posuere commodo lacus. Aenean lobortis augue nec molestie posuere. Praesent non massa ultricies, placerat magna lobortis, porta enim. Nulla dictum odio magna, et tempus velit luctus pharetra. Ut quis eros ut magna egestas vestibulum eget sit amet urna. Maecenas euismod lectus ut enim pretium mollis. Praesent tellus tellus, tincidunt a velit non, varius semper nisi.',
  },
  {
    id: 3,
    title: 'Summer Party',
    date: 'July 7th 2017',
    place: 'Lviv, Ukraine',
    image: 'https://images.pexels.com/photos/1164985/pexels-photo-1164985.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean hendrerit bibendum massa, at sollicitudin augue suscipit dictum. Aliquam euismod gravida ex, eu rutrum est dictum quis. Cras quis facilisis quam. Vestibulum vestibulum augue enim, ut sollicitudin nibh faucibus eu. Vivamus volutpat enim nisl, non tincidunt urna sodales feugiat. Etiam egestas interdum justo eget dignissim. Nulla facilisi. Etiam sagittis neque euismod iaculis accumsan. Nullam laoreet enim ligula. Maecenas sed risus mollis, aliquet odio et, convallis sem. Pellentesque venenatis, dui non pulvinar sodales, ipsum tellus tincidunt nisl, vel commodo arcu velit eget nulla. Integer eu facilisis est, vitae vehicula eros. Sed magna dui, accumsan sit amet mi a, rutrum lobortis lacus. Morbi efficitur massa ac sem aliquam maximus. Nullam libero purus, mollis vitae dolor non, posuere commodo lacus. Aenean lobortis augue nec molestie posuere. Praesent non massa ultricies, placerat magna lobortis, porta enim. Nulla dictum odio magna, et tempus velit luctus pharetra. Ut quis eros ut magna egestas vestibulum eget sit amet urna. Maecenas euismod lectus ut enim pretium mollis. Praesent tellus tellus, tincidunt a velit non, varius semper nisi.',
  },
  {
    id: 4,
    title: 'Magic of Photo',
    date: 'Nov 20th 2020',
    place: 'Kyiv, Ukraine',
    image: 'https://images.pexels.com/photos/1540977/pexels-photo-1540977.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean hendrerit bibendum massa, at sollicitudin augue suscipit dictum. Aliquam euismod gravida ex, eu rutrum est dictum quis. Cras quis facilisis quam. Vestibulum vestibulum augue enim, ut sollicitudin nibh faucibus eu. Vivamus volutpat enim nisl, non tincidunt urna sodales feugiat. Etiam egestas interdum justo eget dignissim. Nulla facilisi. Etiam sagittis neque euismod iaculis accumsan. Nullam laoreet enim ligula. Maecenas sed risus mollis, aliquet odio et, convallis sem. Pellentesque venenatis, dui non pulvinar sodales, ipsum tellus tincidunt nisl, vel commodo arcu velit eget nulla. Integer eu facilisis est, vitae vehicula eros. Sed magna dui, accumsan sit amet mi a, rutrum lobortis lacus. Morbi efficitur massa ac sem aliquam maximus. Nullam libero purus, mollis vitae dolor non, posuere commodo lacus. Aenean lobortis augue nec molestie posuere. Praesent non massa ultricies, placerat magna lobortis, porta enim. Nulla dictum odio magna, et tempus velit luctus pharetra. Ut quis eros ut magna egestas vestibulum eget sit amet urna. Maecenas euismod lectus ut enim pretium mollis. Praesent tellus tellus, tincidunt a velit non, varius semper nisi.',
  },
  {
    id: 5,
    title: 'Rock Fest',
    date: 'Jan 24th 2017',
    place: 'Kharkiv, Ukraine',
    image: 'https://images.pexels.com/photos/2311713/pexels-photo-2311713.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean hendrerit bibendum massa, at sollicitudin augue suscipit dictum. Aliquam euismod gravida ex, eu rutrum est dictum quis. Cras quis facilisis quam. Vestibulum vestibulum augue enim, ut sollicitudin nibh faucibus eu. Vivamus volutpat enim nisl, non tincidunt urna sodales feugiat. Etiam egestas interdum justo eget dignissim. Nulla facilisi. Etiam sagittis neque euismod iaculis accumsan. Nullam laoreet enim ligula. Maecenas sed risus mollis, aliquet odio et, convallis sem. Pellentesque venenatis, dui non pulvinar sodales, ipsum tellus tincidunt nisl, vel commodo arcu velit eget nulla. Integer eu facilisis est, vitae vehicula eros. Sed magna dui, accumsan sit amet mi a, rutrum lobortis lacus. Morbi efficitur massa ac sem aliquam maximus. Nullam libero purus, mollis vitae dolor non, posuere commodo lacus. Aenean lobortis augue nec molestie posuere. Praesent non massa ultricies, placerat magna lobortis, porta enim. Nulla dictum odio magna, et tempus velit luctus pharetra. Ut quis eros ut magna egestas vestibulum eget sit amet urna. Maecenas euismod lectus ut enim pretium mollis. Praesent tellus tellus, tincidunt a velit non, varius semper nisi.',
  },
  {
    id: 6,
    title: 'Summer Party',
    date: 'July 7th 2017',
    place: 'Lviv, Ukraine',
    image: 'https://images.pexels.com/photos/1694348/pexels-photo-1694348.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean hendrerit bibendum massa, at sollicitudin augue suscipit dictum. Aliquam euismod gravida ex, eu rutrum est dictum quis. Cras quis facilisis quam. Vestibulum vestibulum augue enim, ut sollicitudin nibh faucibus eu. Vivamus volutpat enim nisl, non tincidunt urna sodales feugiat. Etiam egestas interdum justo eget dignissim. Nulla facilisi. Etiam sagittis neque euismod iaculis accumsan. Nullam laoreet enim ligula. Maecenas sed risus mollis, aliquet odio et, convallis sem. Pellentesque venenatis, dui non pulvinar sodales, ipsum tellus tincidunt nisl, vel commodo arcu velit eget nulla. Integer eu facilisis est, vitae vehicula eros. Sed magna dui, accumsan sit amet mi a, rutrum lobortis lacus. Morbi efficitur massa ac sem aliquam maximus. Nullam libero purus, mollis vitae dolor non, posuere commodo lacus. Aenean lobortis augue nec molestie posuere. Praesent non massa ultricies, placerat magna lobortis, porta enim. Nulla dictum odio magna, et tempus velit luctus pharetra. Ut quis eros ut magna egestas vestibulum eget sit amet urna. Maecenas euismod lectus ut enim pretium mollis. Praesent tellus tellus, tincidunt a velit non, varius semper nisi.',
  },
];

const Button = ({
  children,
  className,
  ...rest
}) => {
  const classNames = cx('button', className);

  return (
    <button className={classNames} {...rest}>
      {children}
    </button>
  );
};

const Container = React.forwardRef(({
  className,
  as: Component,
  children,
  ...props
}, ref) => {
  const classNames = cx('container', className);

  return (
    <Component className={classNames} ref={ref} {...props}>
      {children}
    </Component>
  );
});

Container.defaultProps = {
  as: 'div',
};

const Address = ({
  data,
}) => (
  <div>
    <address className='header__address'>
      <i className='fas fa-map-marker-alt' />
      {data.place}
    </address>
  </div>
);

const HeaderTitle = ({
  data,
}) => (
  <h1 className='header__title'>{data.title}</h1>
);

const HeaderDate = ({
  data,
}) => (
  <time className='header__date'>{data.date}</time>
);

const HeaderTop = ({
  data,
}) => (
  <div className='header__top'>
    <HeaderTitle data={data} />
    <HeaderDate data={data} />
  </div>
);

const HeaderItem = ({
  data,
}) => {
  return (
    <Container className='header__item'>
      <HeaderTop data={data} />
      <Address data={data} />
    </Container>
  );
};

const Header = ({
  data,
  index,
  as: Component,
}) => {
  const [prev] = React.useState({ index });

  const transitions = useTransition(index, p => p, {
    from: (newIdx) => {
      const dir = newIdx - prev.index;
      prev.index = newIdx;
      return { opacity: 0, transform: `translate3d(0, ${100 * dir}%, 0)` };
    },
    enter: () => {
      return { opacity: 1, transform: `translate3d(0, 0%, 0)` };
    },
    leave: (newIdx) => {
      const dir = newIdx - index;
      return { opacity: 0, transform: `translate3d(0, ${100 * dir}%, 0)` };
    },
  })

  return (
    <div className='header'>
      {transitions.map(({ item, props, key }) => {
        return (
          <animated.div
            key={key}
            style={props}
          >
            <Component data={data[item]} />
          </animated.div>
        )
      })}
    </div>
  )
};

const Footer = () => {
  return (
    <Container className='footer'>
      <Button className='burger-button'>
        <i className='fas fa-bars' />
      </Button>
      <Button className='event-button'>
        <i className='fas fa-plus' />
        Create Event
      </Button>
    </Container>
  );
};

const MAX_COUNT = 3;

const onNext = (
  { args: [index], down },
  { isNextTrigger, getStartData, onChange, ref, drag },
  i,
) => {
  if (!isNextTrigger || down) {
    return
  }

  if (index === i) {
    return {
      ...getStartData(i),
      x: -ref.current.offsetWidth,
      sc: 1,
      opacity: 1,
      immediate: false,
      onStart: () => {
        onChange(index + 1);
      },
      onRest: () => {
        drag.cancel();
      },
    };
  }

  if (i - index > 0) {
    const currentIndex = i - index - 1;
    return {
      ...getStartData(currentIndex),
      immediate: false,
      onStart: undefined,
      onRest: undefined,
    };
  }
};

const onPrev = (
  { args: [index], down },
  { isPrevTrigger, getStartData, onChange, drag },
  i,
) => {
  if (!isPrevTrigger || down) {
    return;
  }

  if (index > 0 && i - index >= -1 && isPrevTrigger) {
    const currentIndex = i - index + 1;

    let indexConf = {
      onStart: undefined,
      onRest: undefined,
    };

    if (index === i) {
      indexConf.onStart = () => {
        onChange(index - 1);
      };

      indexConf.onRest = () => {
        drag.cancel();
      };
    }

    return {
      ...getStartData(currentIndex),
      immediate: false,
      ...indexConf,
    };
  }
};

const isNotTarget = (
  { args: [index] },
  data, i,
) => {
  if (index !== i) {
    return {
      onStart: undefined,
      onRest: undefined,
    };
  }
};

const isNotDown = (
  { down },
  { drag },
) => {
  if (down) {
    return;
  }

  return {
    x: 0,
    immediate: false,
    onRest: () => {
      drag.cancel();
    },
  };
};

const onDefault = ({
  movement,
}) => ({
  x: movement[0],
  immediate: true,
  reset: false,
  onStart: undefined,
  onRest: undefined,
});

const useIsDrag = () => {
  const [state] = React.useState({});
  const setIsDrag = (movement) => {
    const xMod = Math.abs(movement[0]);

    if (xMod > 2) {
      state.isDrag = true;
    }
  };

  const cancel = () => {
    state.isDrag = false;
  };

  return {
    state,
    setIsDrag,
    cancel,
  }
};

const useSlider = ({
  data,
  onChange,
  ref,
  onClick,
}) => {
  const totalItems = data.length;
  const drag = useIsDrag();
  const getStartData = (i) => {
    const isVisible = i <= MAX_COUNT - 1;
    const multiplier =  i === 0 ? 1 : 1.1;

    return ({
      x: isVisible ? i * 28 / multiplier : (MAX_COUNT - 1) * 28,
      y: 0,
      sc: isVisible ? 1 / (MAX_COUNT / (MAX_COUNT * multiplier - i)) : 1 / MAX_COUNT,
      opacity: isVisible ? 1 / (MAX_COUNT / (MAX_COUNT - i)) : 0,
      display: 'block',
      pointerEvents: i === 0 ? '' : 'none',
      boxShadow: i === 0 ? '0 10px 40px rgba(0, 0, 0, .2)' : '0 0px 0px rgba(0, 0, 0, .2)',
      position: '',
      transformOrigin: '',
      width: '',
      height: '',
    })
  };
  const [props, set] = useSprings(totalItems, getStartData);

  const bind = useGesture({
    onDrag: (state) => { 
      const { args: [index], down, movement, cancel } = state;
      const isNextTrigger = movement[0] <= -100 && index !== totalItems - 1;
      const isPrevTrigger = movement[0] >= 24;

      const data = {
        isNextTrigger,
        isPrevTrigger,
        getStartData,
        onChange,
        ref,
        drag,
      };

      if (down) {
        drag.setIsDrag(movement);
      }

      if ((isNextTrigger || isPrevTrigger) && down) {
        cancel(index);
      }

      set(i => {
        const action = R.find(
          fn => fn(state, data, i),
          [
            onNext,
            onPrev,
            isNotTarget,
            isNotDown,
            onDefault,
          ],
        );

        if (action) {
          return action(state, data, i);
        }
      });
    },
  });

  const map = (component) => {
    return props.map(({ x, y, display, sc, opacity, pointerEvents, boxShadow, ...rest }, i) => {
      const root = {
        key: i,
        style: {
          display,
          transform: interpolate([x, y, sc], (x, y, s) => `translate3d(${x}px, ${y}px, 0) scale(${s})`),
          opacity,
          pointerEvents,
          zIndex: data.length - i,
          ...rest,
        },
        ...bind(i),
      };

      const inner = {
        style: {
          boxShadow,
        },
      };

      const onClickHandler = (...args) => {
        if (drag.state.isDrag) {
          return;
        }

        onClick(set, i, ...args);
      };

      return (
        component({
          root,
          inner,
          ref,
          item: data[i],
          onClick: onClickHandler,
        })
      );
    });
  };

  return {
    map,
    ref,
    set,
    getStartData,
  };
};


const Slider = ({
  slider,
}) => {
  const { map, ref } = slider;

  return (
    <div className='slider' ref={ref}>
      <div className='slider__container'>
        {map(({ root, inner, onClick, item, itemRef }) => {
          const videoSrc = R.path(['video'])(item);
          const videoPoster = R.path(['poster'])(item);

          return (
            <animated.div ref={itemRef} className='slider__item' onClick={onClick} {...root}>
              <animated.div
                className='slider__inner' {...inner}
                style={{
                  backgroundImage: `url(${R.path(['image'])(item)})`,
                  ...inner,
                }}
              >
                {videoSrc && (
                  <video src={videoSrc} poster={videoPoster} autoPlay loop muted playsInline />
                )}
              </animated.div>
            </animated.div>
          );
        })}
      </div>
    </div>
  );
};


const ScreenModal = ({
  onClose,
  isOpen,
  children,
}) => {
  const mainSpring = useSpring({
    from: { x: 0 },
    x: isOpen ? 1 : 0,
    pointerEvents: isOpen ? '' : 'none',
  });

  const contentSpring = useSpring({
    from: { x: 0 },
    x: isOpen ? 1 : 0,
    pointerEvents: isOpen ? '' : 'none',
    config: { duration: 400 },
  });

  return (
    <ScreenModalRoot mainSpring={mainSpring}>
      <ScreenModalTopBar mainSpring={mainSpring}>
        <Button className='nav-bar__back' onClick={onClose}>
          <i className='fas fa-long-arrow-alt-left' />
          Events
        </Button>
      </ScreenModalTopBar>
      <ScreenModalContainer
        mainSpring={mainSpring}
        contentSpring={contentSpring}
        children={children}
      />
    </ScreenModalRoot>
  );
};

const ScreenModalRoot = ({
  mainSpring,
  children,
}) => (
  <animated.div
    className='screen-modal-root'
    style={{
      pointerEvents: mainSpring.pointerEvents,
    }}
    children={children}
  />
);

const ScreenModalTopBar = ({
  mainSpring,
  children,
}) => (
  <Container
    as={animated.div}
    style={{
      color: 'white',
      opacity: mainSpring.x.interpolate({ range: [0, 1], output: [0, 1] }),
      transform: mainSpring.x
        .interpolate({
          range: [0, 1],
          output: [100, 0]
        })
        .interpolate(x => `translate3d(0, ${x}%, 0`)
    }}
    children={children}
  />
);

const ScreenModalContainer = ({
  mainSpring,
  contentSpring,
  children,
}) => (
  <animated.div
    className='screen-modal'
    style={{
      transform: mainSpring.x
        .interpolate({
          range: [0, 1],
          output: [100, 0]
        })
        .interpolate(x => `translate3d(0, ${x}%, 0`)
    }}
  >
    <animated.div
      className='screen-modal__scroll'
      style={{
        opacity: contentSpring.x.interpolate({ range: [0, 1], output: [0, 1] }),
        transform: contentSpring.x
          .interpolate({
            range: [0, 1],
            output: [100, 0]
          })
          .interpolate(x => `translate3d(0, ${x}%, 0`)
      }}
    >
      {children}
    </animated.div>
  </animated.div>
);

const ScreenModalContent = ({
  data,
}) => (
  <div>
    <Container className='screen-modal__content'>
      <HeaderTitle data={data} />
      <Address data={data} />
      <HeaderDate data={data} />
    </Container>
    <Container>
      <p>{data.text}</p>
    </Container>
  </div>
);

const Screen = () => {
  const [current, setCurrent] = React.useState(0);
  const [isOpened, setIsOpened] = React.useState(false);
  const ref = React.useRef();
  const slider = useSlider({
    data: pages,
    onChange: setCurrent,
    ref,
    onClick: (set, index, event) => {
      const el = event.currentTarget
      const rect = el.getBoundingClientRect();

      const ws = window.innerWidth / el.offsetWidth;
      const hs = window.innerHeight / el.offsetHeight;

      set((i) => {
        if (index === i) {
          setIsOpened(true);

          return {
            x: (window.innerWidth / 2) - (rect.width / 2 ) - rect.x,
            y: (window.innerHeight / 2) - (rect.height / 2 ) - rect.y,
            sc: Math.max(ws, hs),
            pointerEvents: 'none',
            transformOrigin: 'center center'
          };
        }
      });
    },
  });

  const onCloseClick = () => {
    slider.set((i) => {
      if (i === current) {
        setIsOpened(false);
        return {
          ...slider.getStartData(0),
          transformOrigin: 'center center'
        };
      }
    })
  };

  const mainSpring = useSpring({
    from: { x: 0 },
    x: !isOpened ? 1 : 0,
  });

  const data = pages[current];

  return (
    <section className='events-screen'>
      <Container
        as={animated.div}
        className='nav-bar'
        style={{
          opacity: mainSpring.x.interpolate({ range: [0, 1], output: [0, 1] }),
          transform: mainSpring.x
            .interpolate({
              range: [0, 1],
              output: [-100, 0]
            })
            .interpolate(x => `translate3d(0, ${x}%, 0`),
        }}
      >
        <Button className='nav-bar__back'>
          <i className='fas fa-long-arrow-alt-left' />
          Events
        </Button>
      </Container>
      <Header data={pages} index={current} as={HeaderItem} />
      <div className='events-screen__slider'>
        <Slider slider={slider} />
      </div>
      <ScreenModal onClose={onCloseClick} isOpen={isOpened}>
        <ScreenModalContent key={data.id} data={data} />
      </ScreenModal>
      <Footer />
      <Container>
        <div className="credits">Created with <span class="love"></span> by <a href="https://twitter.com/odintsov_design" target="_blank">Ivan Odintsov</a>&nbsp;&nbsp;&middot;&nbsp;&nbsp;Inspired by <a href="https://dribbble.com/shots/3731362-Event-cards-iOS-interaction" target="_blank">Divan Raj</a></div>
      </Container>
    </section>
  );
};

const AppLayout = ({
  children,
}) => {
  return (
    <div className='app-layout'>
      {children}
    </div>
  );
};

const App = () => {
  return (
    <AppLayout>
      <Screen />
    </AppLayout>
  );
};

ReactDOM.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>,
  document.getElementById('root')
);
