const { defineConfig } = require('cypress')

module.exports = defineConfig({
    chromeWebSecurity: false,
    retries: 2,
    defaultCommandTimeout: 5000,
    watchForFileChanges: false,
    videosFolder: 'y/videos',
    screenshotsFolder: 'y/screenshots',
    fixturesFolder: 'y/fixture',
    e2e: {
        setupNodeEvents(on, config) {
            return require('./y/plugins/index.js')(on, config)
        },
        baseUrl: 'http://localhost:8000/',
        specPattern: 'y/integration/**/*.cy.{js,jsx,ts,tsx}',
        supportFile: 'y/support/index.js',
    },
})
