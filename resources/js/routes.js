import Index from './pages/Index';

//Admin Route
import AdminDashboard from './pages/admin/AdminDashboard';
import AdminProfile from './pages/admin/AdminProfile';
import AdminMessenger from './pages/admin/AdminMessenger';
import AdminSchedule from './pages/admin/AdminSchedule';
import AdminStudent from './pages/admin/AdminStudent';
import AdminSubjectTeacher from './pages/admin/AdminSubjectTeacher';
import AdminResearchPersonnel from './pages/admin/AdminResearchPersonnel';
import AdminCapstone1 from './pages/admin/AdminCapstone1';
import AdminCapstone2 from './pages/admin/AdminCapstone2';
import AdminCapstoneDone from './pages/admin/AdminCapstoneDone'
import ViewMinutes from './pages/admin/ViewMinutes'
import TitleOutlineMinutes from './pages/admin/TitleOutlineMinutes'
import FinalMinutes from './pages/admin/FinalMinutes'
import AdminViewdocuments from './pages/admin/AdminViewdocuments'
import AdminAdddocuments from './pages/admin/AdminAdddocuments'
import AdviserperGroupReport from './pages/admin/Reports/AdviserperGroupReport'
import EvaluationReport from './pages/admin/Reports/EvaluationReport'
import GroupProgressReport from './pages/admin/Reports/GroupProgressReport'
import ListofResearchReport from './pages/admin/Reports/ListofResearchReport'
import ResearchPersonnelReport from './pages/admin/Reports/ResearchPersonnelReport'
import ScheduleReport from './pages/admin/Reports/ScheduleReport'

//Adviser Route
import AdviserDashboard from './pages/adviser/AdviserDashboard';
import AdviserProfile from './pages/adviser/AdviserProfile';
import AdviserMessenger from './pages/adviser/AdviserMessenger';
import AdviserGrouprequest from './pages/adviser/AdviserGrouprequest';
import AdviserCapstone1 from './pages/adviser/AdviserCapstone1';
import AdviserCapstone2 from './pages/adviser/AdviserCapstone2';
import AdviserSchedule from './pages/adviser/AdviserSchedule';

//Panel Route
import PanelDashboard from './pages/panel/PanelDashboard';
import PanelProfile from './pages/panel/PanelProfile'
import PanelMessenger from './pages/panel/PanelMessenger';
import PanelGroupRequest from './pages/panel/PanelGroupRequest';
import PanelGroup from './pages/panel/PanelGroup';
import PanelSchedule from './pages/panel/PanelSchedule'

//Subject Teacher
import SubjectteacherDashboard from './pages/subjectteacher/SubjectteacherDashboard'
import SubjectteacherProfile from './pages/subjectteacher/SubjectteacherProfile'
import SubjectteacherMessenger from './pages/subjectteacher/SubjectteacherMessenger';
import SubjectteacherSchedule from './pages/subjectteacher/SubjectteacherSchedule'
import SubjectteacherSection1 from './pages/subjectteacher/SubjectteacherSection1'
import SubjectteacherSection2 from './pages/subjectteacher/SubjectteacherSection2'
import SubjectteacherGroups from './pages/subjectteacher/SubjectteacherGroups'

//Student Route
import StudentDashboard from './pages/student/StudentDashboard';
import StudentProfile from './pages/student/StudentProfile';
import StudentMessenger from './pages/student/StudentMessenger';
import StudentGroup from './pages/student/StudentGroup';
import StudentEvaluation from './pages/student/StudentEvaluation';
import StudentGroupInformation from './pages/student/StudentGroupInformation';
import StudentGroupMinutes from './pages/student/StudentGroupMinutes';
import StudentGroupSubmission from './pages/student/StudentGroupSubmission';
import StudentResearchlist from './pages/student/StudentResearchlist';
import StudentSchedule from './pages/student/StudentSchedule';
import StudentSection from './pages/student/StudentSection'

export default[
    {
        path: '/',
        component: Index,
        name: 'index'
    },
    //admin Route
    {
        path: '/admin/dashboard',
        component: AdminDashboard,
        name: 'AdminDashboard'
    },
    {
        path: '/admin/profile',
        component: AdminProfile,
        name: 'AdminProfile'
    },
    {
        path: '/admin/messenger',
        component: AdminMessenger,
        name: 'AdminMessenger'
    },
    {
        path: '/admin/schedule',
        component: AdminSchedule,
        name: 'AdminSchedule'
    },
    {
        path: '/admin/student',
        component: AdminStudent,
        name: 'AdminStudent'
    },
    {
        path: '/admin/subjectteacher',
        component: AdminSubjectTeacher,
        name: 'AdminSubjectTeacher'
    },
    {
        path: '/admin/researchpersonnel',
        component: AdminResearchPersonnel,
        name: 'AdminResearchPersonnel'
    },
    {
        path: '/admin/capstone1',
        component: AdminCapstone1,
        name: 'AdminCapstone1'
    },
    {
        path: '/admin/capstone2',
        component: AdminCapstone2,
        name: 'AdminCapstone2'
    },
    {
        path: '/admin/groupdone',
        component: AdminCapstoneDone,
        name: 'AdminCapstoneDone'
    },
    {
        path: '/admin/viewminutes',
        component: ViewMinutes,
        name: 'ViewMinutes'
    },
    {
        path: '/admin/titleoutlineminutes',
        component: TitleOutlineMinutes,
        name: 'TitleOutlineMinutes'
    },
    {
        path: '/admin/finalminutes',
        component: FinalMinutes,
        name: 'FinalMinutes'
    },
    {
        path: '/admin/viewdocuments',
        component: AdminViewdocuments,
        name: 'AdminViewdocuments'
    },
    {
        path: '/admin/adddocument',
        component: AdminAdddocuments,
        name: 'AdminAdddocuments'
    },
    {
        path: '/admin/adviserreports',
        component: AdviserperGroupReport,
        name: 'AdviserperGroupReport'
    },
    {
        path: '/admin/evaluationreport',
        component: EvaluationReport,
        name: 'EvaluationReport'
    },
    {
        path: '/admin/groupprogressreport',
        component: GroupProgressReport,
        name: 'GroupProgressReport'
    },
    {
        path: '/admin/listofresearchreport',
        component:ListofResearchReport ,
        name: 'ListofResearchReport'
    },
    {
        path: '/admin/researchpersonnelreport',
        component: ResearchPersonnelReport,
        name: 'ResearchPersonnelReport'
    },
    {
        path: '/admin/schedulereport',
        component: ScheduleReport,
        name: 'ScheduleReport'
    },

    //Adviser Route
    {
        path: '/adviser/dashboard',
        component: AdviserDashboard,
        name: 'AdviserDashboard'
    },
    {
        path: '/adviser/profile',
        component: AdviserProfile,
        name: 'AdviserProfile'
    },
    {
        path: '/adviser/messenger',
        component: AdviserMessenger,
        name: 'AdviserMessenger'
    },
    {
        path: '/adviser/grouprequest',
        component: AdviserGrouprequest,
        name: 'AdviserGrouprequest'
    },
    {
        path: '/adviser/capstone1',
        component: AdviserCapstone1,
        name: 'AdviserCapstone1'
    },
    {
        path: '/adviser/capstone2',
        component: AdviserCapstone2,
        name: 'AdviserCapstone2'
    },
    {
        path: '/adviser/schedule',
        component: AdviserSchedule,
        name: 'AdviserSchedule'
    },
    //Panel Route
    {
        path: '/panel/dashboard',
        component: PanelDashboard,
        name: 'PanelDashboard'
    },
    {
        path: '/panel/profile',
        component: PanelProfile,
        name: 'PanelProfile'
    },
    {
        path: '/panel/messenger',
        component: PanelMessenger,
        name: 'PanelMessenger'
    },
    {
        path: '/panel/grouprequest',
        component: PanelGroupRequest,
        name: 'PanelGroupRequest'
    },
    {
        path: '/panel/group',
        component: PanelGroup,
        name: 'PanelGroup'
    },
    {
        path: '/panel/schedule',
        component: PanelSchedule,
        name: 'PanelSchedule'
    },

    //Subject Teacher Route
    {
        path: '/subjectteacher/dashboard',
        component: SubjectteacherDashboard,
        name: 'SubjectteacherDashboard'
    },
    {
        path: '/subjectteacher/profile',
        component: SubjectteacherProfile,
        name: 'SubjectteacherProfile'
    },
    {
        path: '/subjectteacher/messenger',
        component: SubjectteacherMessenger,
        name: 'SubjectteacherMessenger'
    },
    {
        path: '/subjectteacher/schedule',
        component: SubjectteacherSchedule,
        name: 'SubjectteacherSchedule'
    },
    {
        path: '/subjectteacher/sections1',
        component: SubjectteacherSection1,
        name: 'SubjectteacherSection1'
    },
    {
        path: '/subjectteacher/sections2',
        component: SubjectteacherSection2,
        name: 'SubjectteacherSection2'
    },
    {
        path: '/subjectteacher/groups',
        component: SubjectteacherGroups,
        name: 'SubjectteacherGroups'
    },

    //Student Route
    {
        path: '/student/dashboard',
        component: StudentDashboard,
        name: 'StudentDashboard'
    },
    {
        path: '/student/profile',
        component: StudentProfile,
        name: 'StudentProfile'
    },
    {
        path: '/student/messenger',
        component: StudentMessenger,
        name: 'StudentMessengers'
    },
    {
        path: '/student/group',
        component: StudentGroup,
        name: 'StudentGroup'
    },
    {
        path: '/student/schedule',
        component: StudentSchedule,
        name: 'StudentSchedule'
    },
    {
        path: '/student/researchlist',
        component: StudentResearchlist,
        name: 'StudentResearchlist'
    },
    {
        path: '/student/evaluation',
        component: StudentEvaluation,
        name: 'StudentEvaluation'
    },
    {
        path: '/student/information',
        component: StudentGroupInformation,
        name: 'StudentGroupInformation'
    },
    {
        path: '/student/submission',
        component: StudentGroupSubmission,
        name: 'StudentGroupSubmission'
    },
    {
        path: '/student/section',
        component: StudentSection,
        name: 'StudentSection'
    },
    {
        path: '/student/minutes',
        component: StudentGroupMinutes,
        name: 'StudentGroupMinutes'
    },
];
