<?php
namespace Deployer;

use http\Message\Body;

require 'recipe/symfony.php';

// Project name
set('application', 'API_REST_ILAN');

// Project repository
set('repository', 'git@github.com:IlanRubinsohn/API_REST_ILAN.git');

set('composer_options', 'install --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);
set('git_recursive', false);
// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('20.188.34.16')
    ->user('azureuser')
    ->addSshOption('UserKnownHostsFile', '/dev/null')
    ->addSshOption('StrictHostKeyChecking', 'no')
    ->set('deploy_path', '~/{{application}}');

// Tasks

task('deploy', [
    'deploy:unlock',
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:clear_paths',
    'deploy:shared',
    'deploy:rename_env',
    'deploy:vendors',
    'force_cache',
    'deploy:writable',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

task('build', function () {
    run('cd {{release_path}} && build');
});

task('force_cache',function (){
    run('rm -fr {{release_path}}/cache');
});


task('deploy:rename_env', function () {
   run('cp {{deploy_path}}/.env {{release_path}}/.env');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');

