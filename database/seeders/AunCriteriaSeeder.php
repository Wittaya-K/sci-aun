<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AunCriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $criteria = [
            [
                'number'     => 1,
                'title'      => 'Expected Learning Outcomes',
                'sort_order' => 1,
                'sub'        => [
                    ['number' => '1.1', 'sort_order' => 1, 'title' => 'The programme to show that the expected learning outcomes are appropriately formulated in accordance with an established learning taxonomy, are aligned to the vision and mission of the university, and are known to all stakeholders.'],
                    ['number' => '1.2', 'sort_order' => 2, 'title' => 'The programme to show that the expected learning outcomes for all courses are appropriately formulated and are aligned to the expected learning outcomes of the programme.'],
                    ['number' => '1.3', 'sort_order' => 3, 'title' => 'The programme to show that the expected learning outcomes consist of both generic outcomes and subject specific outcomes.'],
                    ['number' => '1.4', 'sort_order' => 4, 'title' => 'The programme to show that the requirements of the stakeholders, especially the external stakeholders, are gathered, and that these are reflected in the expected learning outcomes.'],
                    ['number' => '1.5', 'sort_order' => 5, 'title' => 'The programme to show that the expected learning outcomes are achieved by the students by the time they graduate.'],
                ],
            ],
            [
                'number'     => 2,
                'title'      => 'Programme Structure and Content',
                'sort_order' => 2,
                'sub'        => [
                    ['number' => '2.1', 'sort_order' => 1, 'title' => 'The programme to show that the programme structure and content are designed to achieve the expected learning outcomes.'],
                    ['number' => '2.2', 'sort_order' => 2, 'title' => 'The programme to show that the programme content is current and updated regularly.'],
                    ['number' => '2.3', 'sort_order' => 3, 'title' => 'The programme to show that the programme content is logically sequenced and coherent.'],
                    ['number' => '2.4', 'sort_order' => 4, 'title' => 'The programme to show that the academic standards are appropriately set.'],
                ],
            ],
            [
                'number'     => 3,
                'title'      => 'Teaching and Learning Approach',
                'sort_order' => 3,
                'sub'        => [
                    ['number' => '3.1', 'sort_order' => 1, 'title' => 'The programme to show that the educational philosophy is explicit and designed to achieve the expected learning outcomes.'],
                    ['number' => '3.2', 'sort_order' => 2, 'title' => 'The programme to show that teaching and learning activities are constructively aligned with the expected learning outcomes.'],
                    ['number' => '3.3', 'sort_order' => 3, 'title' => 'The programme to show that the research component is incorporated in the teaching and learning process.'],
                    ['number' => '3.4', 'sort_order' => 4, 'title' => 'The programme to show that students are exposed to research and up-to-date developments in the field.'],
                ],
            ],
            [
                'number'     => 4,
                'title'      => 'Student Assessment',
                'sort_order' => 4,
                'sub'        => [
                    ['number' => '4.1', 'sort_order' => 1, 'title' => 'The programme to show that student assessment is constructively aligned with the expected learning outcomes.'],
                    ['number' => '4.2', 'sort_order' => 2, 'title' => 'The programme to show that the student assessment including the grading system is explicit, consistent, and made known to students.'],
                    ['number' => '4.3', 'sort_order' => 3, 'title' => 'The programme to show that the assessment methods are sufficient to measure the expected learning outcomes and to classify levels of student achievement.'],
                    ['number' => '4.4', 'sort_order' => 4, 'title' => 'The programme to show that the assessment uses student work to improve teaching and learning.'],
                    ['number' => '4.5', 'sort_order' => 5, 'title' => 'The programme to show that student assessment relies on transparent processes.'],
                    ['number' => '4.6', 'sort_order' => 6, 'title' => 'The programme to show that students have timely access to feedback and support from academic staff.'],
                ],
            ],
            [
                'number'     => 5,
                'title'      => 'Academic Staff',
                'sort_order' => 5,
                'sub'        => [
                    ['number' => '5.1', 'sort_order' => 1, 'title' => 'The programme to show that the academic staff planning (considering succession, staff deployment, workload, research, and teaching) is undertaken and that the profile of the academic staff is sufficient to deliver the curriculum.'],
                    ['number' => '5.2', 'sort_order' => 2, 'title' => 'The programme to show that the academic staff are competent and qualified to teach and conduct research.'],
                    ['number' => '5.3', 'sort_order' => 3, 'title' => 'The programme to show that academic staff duties, feedback mechanisms, and welfare are managed.'],
                    ['number' => '5.4', 'sort_order' => 4, 'title' => 'The programme to show that the training and developmental needs of academic staff are identified and activities are implemented to fulfil them.'],
                ],
            ],
            [
                'number'     => 6,
                'title'      => 'Student Support Services',
                'sort_order' => 6,
                'sub'        => [
                    ['number' => '6.1', 'sort_order' => 1, 'title' => 'The programme to show that the student intake policy and admission criteria are clearly defined and effectively communicated.'],
                    ['number' => '6.2', 'sort_order' => 2, 'title' => 'The programme to show that the management of student progress includes monitoring and advising students.'],
                    ['number' => '6.3', 'sort_order' => 3, 'title' => 'The programme to show that academic and non-academic support services are available and sufficient.'],
                    ['number' => '6.4', 'sort_order' => 4, 'title' => 'The programme to show that the physical, social, and psychological environment is conducive to education and research.'],
                ],
            ],
            [
                'number'     => 7,
                'title'      => 'Facilities and Infrastructure',
                'sort_order' => 7,
                'sub'        => [
                    ['number' => '7.1', 'sort_order' => 1, 'title' => 'The programme to show that the laboratories and equipment are adequate and up to date.'],
                    ['number' => '7.2', 'sort_order' => 2, 'title' => 'The programme to show that the library and its resources are sufficient and support the programme.'],
                    ['number' => '7.3', 'sort_order' => 3, 'title' => 'The programme to show that the ICT facilities are adequate and up to date.'],
                    ['number' => '7.4', 'sort_order' => 4, 'title' => 'The programme to show that the environment is conducive to education, research, and community engagement.'],
                ],
            ],
            [
                'number'     => 8,
                'title'      => 'Output and Outcomes',
                'sort_order' => 8,
                'sub'        => [
                    ['number' => '8.1', 'sort_order' => 1, 'title' => 'The programme to show that the student progression and graduation rates are monitored and benchmarked for improvement.'],
                    ['number' => '8.2', 'sort_order' => 2, 'title' => 'The programme to show that graduate destinations are monitored and benchmarked for improvement.'],
                    ['number' => '8.3', 'sort_order' => 3, 'title' => 'The programme to show that the quality of graduates is monitored and benchmarked for improvement.'],
                    ['number' => '8.4', 'sort_order' => 4, 'title' => 'The programme to show that research output is monitored and benchmarked for improvement.'],
                ],
            ],
        ];

        foreach ($criteria as $c) {
            $criteriaId = DB::table('aun_criteria')->insertGetId([
                'number'     => $c['number'],
                'title'      => $c['title'],
                'sort_order' => $c['sort_order'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($c['sub'] as $s) {
                DB::table('aun_sub_criteria')->insert([
                    'aun_criteria_id' => $criteriaId,
                    'number'          => $s['number'],
                    'title'           => $s['title'],
                    'sort_order'      => $s['sort_order'],
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);
            }
        }
    }
}
