<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Simple Youtube clone based on Yii2</h1>
</p>
<h2>Live demo</h2>
<ul>
    <li><a target="_blank" href="http://clonetube.andreydev.ru">Frontend part</a></li>
    <li><a target="_blank" href="http://studio.clonetube.andreydev.ru">Backend part</a></li>
</ul>
<p>Project was build with help of Codeholic's youtube video tutorial - <a target="_blank" href="https://youtu.be/whuIf33v2Ug">https://youtu.be/whuIf33v2Ug</a></p>
<p><strong>Not forked or copypasted but built step by step.</strong> Also project has a lot of new functions and differences.</p>
<h2>Differences with tutorial project</h2>
<ul>
    <p>+</p>
    <li>Project is using PostgreSQL instead of MYSQL. Search and Similar videos functionality is using PostgreSQL's full text search</li>
    <li>User profile page functionality</li>
    <li>More video related functionality such as</li>
    <ul>
        <li>Explore page - Shows trending videos, the most viewed videos for the day</li>
        <li>Subscription page - Shows videos by user subscribed channels</li>
    </ul>
    <li>Design and layout, obviously</li>
    <li>REST Api for <code> rest/index rest/view rest/update rest/delete</code> operations with model Videos</li>
    <br>
    <p>-</p>
    <li>You won't be able to sign up because email sending is not implemented on the demo server</li>
    <li>No adaptive layout yet</li>
</ul>
<!--
Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![build](https://github.com/yiisoft/yii2-app-advanced/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-advanced/actions?query=workflow%3Abuild)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
