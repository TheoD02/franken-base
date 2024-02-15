import {registerControllers, startStimulusApp} from "vite-plugin-symfony/stimulus/helpers"
import {registerReactControllerComponents} from "vite-plugin-symfony/stimulus/helpers/react"

const app = startStimulusApp();
registerControllers(
    app,
    import.meta.glob('./controllers/*_(lazy)\?controller.[jt]s(x)\?')
)
registerReactControllerComponents(import.meta.glob('./react/controllers/**/*.[jt]s(x)\?'));
