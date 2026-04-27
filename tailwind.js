tailwind.config = {
    theme: {
        extend: {
            fontFamily: {
                serif: ['Cormorant Garamond', 'serif'],
                sans: ['Montserrat', 'sans-serif'],
                violetbee: ['VioletBee']
            },
            colors: {
                forest: {
                    50: '#f2f7f2',
                    100: '#e1ede1',
                    200: '#c5dbc5',
                    300: '#9aba9a',
                    400: '#6d946d',
                    500: '#4d754d',
                    600: '#3c5c3c',
                    700: '#324a32',
                    800: '#2a3c2a',
                    900: '#243324',
                }
            },
            keyframes: {
                fadeUp: {
                    '0%': {
                        opacity: '0',
                        transform: 'translateY(60px)',
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateY(0)',
                    },
                },
                fadeRight: {
                    '0%': { opacity: '0', transform: 'translateX(100%)', },
                    '80%': { transform: 'translateX(-10%)' },
                    '100%': {
                        opacity: '1',
                        transform: 'translateX(0)',
                    },
                },
                fadeLeft: {
                    '0%': { opacity: '0', transform: 'translateX(0%)', },
                    '80%': { transform: 'translateX(-10%)' },
                    '100%': {
                        opacity: '1',
                        transform: 'translateX(100)',
                    },
                },
                cloudMove: {
                    '0%': { transform: 'translateX(-120%)' },
                    '100%': { transform: 'translateX(200%)' },
                },
            },
            animation: {
                'fade-up': 'fadeUp 1.2s ease-out forwards',
                'cloud-slow': 'cloudMove 12s linear infinite',
                'slide-right': 'fadeRight 1.2s ease-out forwards',
                'slide-left': 'fadeLeft 1.2s ease-out forwards'
            },
        }
    }
}