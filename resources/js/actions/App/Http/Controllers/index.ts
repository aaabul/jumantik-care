import DashboardController from './DashboardController'
import PemeriksaanController from './PemeriksaanController'
import Settings from './Settings'
const Controllers = {
    DashboardController: Object.assign(DashboardController, DashboardController),
PemeriksaanController: Object.assign(PemeriksaanController, PemeriksaanController),
Settings: Object.assign(Settings, Settings),
}

export default Controllers