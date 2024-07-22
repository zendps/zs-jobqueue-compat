# Zend Server JobQueue API compatibility for ZendHQ

This package provides a compatibility layer for the Zend Server JobQueue PHP API, allowing usage against the ZendHQ JobQueue PHP API.

## Installation

1. Add the repository to your Composer configuration:

   ```bash
   composer config repositories.zsjq vcs "https://github.com/zendps/zs-jobqueue-compat.git"
   ```

2. Add the library to your composer requirements:

   ```bash
   composer require "zendps/zs-jobqueue-compat:dev-master"
   ```

## Usage

The package registers the class `ZendJobQeue`, with the following public API.
Please note the various methods that indicate they are unsupported, as those are ones that may return unexpected values in your application.

```php
<?php
class ZendJobQueue
{
    // Job types

    /**
     * An HTTP job with a relative URL
     */
    public const TYPE_HTTP_RELATIVE = 0;

    /**
     * An HTTP job with an absolute URL
     */
    public const TYPE_HTTP = 1;

    /**
     * A PHP-backed CLI job
     */
    public const TYPE_CLI_PHP = 2;

    /**
     * A CLI job
     */
    public const TYPE_CLI = 3;

    /**
     * A shell job
     */
    public const TYPE_SHELL = 3;

    /**
     * An HTTP job with a relative URL
     */
    public const JOB_TYPE_HTTP_RELATIVE = 1;

    /**
     * An HTTP job with an absolute URL
     */
    public const JOB_TYPE_HTTP = 2;

    /**
     * A shell-based job
     */
    public const JOB_TYPE_SHELL = 8;

    // Job priorities

    /**
     * A low priority job
     */
    public const PRIORITY_LOW = 0;

    /**
     * A normal priority job
     */
    public const PRIORITY_NORMAL = 1;

    /**
     * A high priority job
     */
    public const PRIORITY_HIGH = 2;

    /**
     * An urgent priority job
     */
    public const PRIORITY_URGENT = 3;

    /**
     * A low priority job
     */
    public const JOB_PRIORITY_LOW = 1;

    /**
     * A normal priority job
     */
    public const JOB_PRIORITY_NORMAL = 2;

    /**
     * A high priority job
     */
    public const JOB_PRIORITY_HIGH = 4;

    /**
     * An urgent priority job
     */
    public const JOB_PRIORITY_URGENT = 8;

    // Job statuses

    /**
     * The job is waiting to be processed
     */
    public const JOB_STATUS_PENDING = 1;

    /**
     * The job is waiting for its predecessor's completion
     */
    public const JOB_STATUS_WAITING_PREDECESSOR = 2;

    /**
     * The job is executing
     */
    public const JOB_STATUS_RUNNING = 4;

    /**
     * Job execution has been completed successfully
     */
    public const JOB_STATUS_COMPLETED = 8;

    /**
     * The job was executed and reported its successful completion status
     */
    public const JOB_STATUS_OK = 16;

    /**
     * The job execution failed
     */
    public const JOB_STATUS_FAILED = 32;

    /**
     * The job was executed but reported failed completion status
     */
    public const JOB_STATUS_LOGICALLY_FAILED = 64;

    /**
     * Job execution timeout
     */
    public const JOB_STATUS_TIMEOUT = 128;

    /**
     * A logically removed job
     */
    public const JOB_STATUS_REMOVED = 256;

    /**
     * The job is scheduled to be executed at some specific time
     */
    public const JOB_STATUS_SCHEDULED = 512;

    /**
     * The job execution is suspended
     */
    public const JOB_STATUS_SUSPENDED = 1024;

    /**
     * The job execution failed on the backend
     */
    public const JOB_STATUS_FAILED_BACKEND = 2048;

    /**
     * The job execution failed due to the target URL being inaccessible
     */
    public const JOB_STATUS_FAILED_URL = 4096;

    /**
     * The job execution failed due to the runtime not matching
     */
    public const JOB_STATUS_FAILED_RUNTIME = 8192;

    /**
     * The job execution failed to start
     */
    public const JOB_STATUS_FAILED_START = 16384;

    /**
     * The job execution failed due to the predecessor job failing
     */
    public const JOB_STATUS_FAILED_PREDECESSOR = 32768;

    /**
     * The job execution failed because it was aborted
     */
    public const JOB_STATUS_FAILED_ABORTED = 65536;

    /**
     * The job is waiting to be processed
     */
    public const STATUS_PENDING = 0;

    /**
     * The job is waiting for its predecessor's completion
     */
    public const STATUS_WAITING_PREDECESSOR = 1;

    /**
     * The job is executing
     */
    public const STATUS_RUNNING = 2;

    /**
     * Job execution has been completed successfully
     */
    public const STATUS_COMPLETED = 3;

    /**
     * The job was executed and reported its successful completion status
     */
    public const STATUS_OK = 4;

    /**
     * The job execution failed
     */
    public const STATUS_FAILED = 5;

    /**
     * The job was executed but reported failed completion status
     */
    public const STATUS_LOGICALLY_FAILED = 6;

    /**
     * Job execution timeout
     */
    public const STATUS_TIMEOUT = 7;

    /**
     * A logically removed job
     */
    public const STATUS_REMOVED = 8;

    /**
     * The job is scheduled to be executed at some specific time
     */
    public const STATUS_SCHEDULED = 9;

    /**
     * The job execution is suspended
     */
    public const STATUS_SUSPENDED = 10;

    /**
     * The job execution failed on the backend
     */
    public const STATUS_FAILED_BACKEND = 11;

    /**
     * The job execution failed due to the target URL being inaccessible
     */
    public const STATUS_FAILED_URL = 12;

    /**
     * The job execution failed due to the runtime not matching
     */
    public const STATUS_FAILED_RUNTIME = 13;

    /**
     * The job execution failed to start
     */
    public const STATUS_FAILED_START = 14;

    /**
     * The job execution failed due to the predecessor job failing
     */
    public const STATUS_FAILED_PREDECESSOR = 15;

    /**
     * The job execution failed because it was aborted
     */
    public const STATUS_FAILED_ABORTED = 16;

    // Sorting options

    /**
     * Disable sorting of result set of getJobsList()
     */
    public const SORT_JOB_NONE = 0;

    /**
     * Disable sorting of result set of getJobsList()
     */
    public const SORT_NONE = 0;

    /**
     * Sort result set of getJobsList() by job id
     */
    public const SORT_BY_ID = 1;

    /**
     * Sort result set of getJobsList() by job type
     */
    public const SORT_BY_TYPE = 2;

    /**
     * Sort result set of getJobsList() by job script name
     */
    public const SORT_BY_SCRIPT = 3;

    /**
     * Sort result set of getJobsList() by application name
     */
    public const SORT_BY_APPLICATION = 4;

    /**
     * Sort result set of getJobsList() by job name
     */
    public const SORT_BY_NAME = 5;

    /**
     * Sort result set of getJobsList() by job priority
     */
    public const SORT_BY_PRIORITY = 6;

    /**
     * Sort result set of getJobsList() by job status
     */
    public const SORT_BY_STATUS = 7;

    /**
     * Sort result set of getJobsList() by job predecessor
     */
    public const SORT_BY_PREDECESSOR = 8;

    /**
     * Sort result set of getJobsList() by job persistence flag
     */
    public const SORT_BY_PERSISTENCE = 9;

    /**
     * Sort result set of getJobsList() by job creation time
     */
    public const SORT_BY_CREATION_TIME = 10;

    /**
     * Sort result set of getJobsList() by job schedule time
     */
    public const SORT_BY_SCHEDULE_TIME = 11;

    /**
     * Sort result set of getJobsList() by job start time
     */
    public const SORT_BY_START_TIME = 12;

    /**
     * Sort result set of getJobsList() by job end time
     */
    public const SORT_BY_END_TIME = 13;

    // Sort direction

    /**
     * Sort result set of getJobsList() in direct order
     */
    public const SORT_ASC = 0;

    /**
     * Sort result set of getJobsList() in reverse order
     */
    public const SORT_DESC = 1;

    // Other constants

    /**
     * Constant to report completion status from the jobs using setCurrentJobStatus()
     */
    public const OK = 0;

    /**
     * Constant to report completion status from the jobs using setCurrentJobStatus()
     */
    public const FAILED = 1;

    public static function isJobQueueDaemonRunning(): bool;
    public static function getCurrentJobParams(): array;
    public static function setCurrentJobStatus(int $completion, string $message = ''): void;
    public static function getCurrentJobId(): ?int; // always returns null
    public function __construct(string $binding = ''); // $binding is ignored
    public function createHttpJob(string $url, array $vars, $options, bool $legacyWorker = false): int;
    public function createCliJob(string $command, array $options): int;
    public function createPhpCliJob(string $script, array $vars, array $options): int;
    public function getJobStatus(int $jobId): array;
    public function removeJob(int $jobId): bool;
    public function isSuspended(): bool;
    public function suspendQueue(): void;
    public function resumeQueue(): void;
    public function restartJob(int $jobId): bool;
    public function getStatistics(): array; // Unsupported; returns empty array
    public function getStatisticsByTimespan(int $timeSpan): array; // Unsupported; returns empty array
    public function getConfig(): array; // Unsupported; returns empty array
    public function getQueues(): array;
    public function reloadConfig(): void; // Unsupported; acts as a no-op
    public function getJobInfo(int $jobId): array;
    public function getDependentJobs(): array; // Unsupported; returns empty array
    public function getJobsList(array $filters = [], &$total = null): array;
    public function getApplications(): array; // Unsupported; returns empty array
    public function getSchedulingRules(): array; // Unsupported; returns empty array
    public function getSchedulingRule(): array; // Unsupported; returns empty array
    public function deleteSchedulingRule(): bool; // Unsupported; returns false
    public function suspendSchedulingRule(): bool; // Unsupported; returns false
    public function resumeSchedulingRule(): bool; // Unsupported; returns false
    public function updateSchedulingRule(): bool; // Unsupported; returns false
}
```

## Recommendations

We recommend using this polyfill only while migrating from Zend Server to ZendPHP, and rewriting your JobQueue code to follow the [documented ZendHQ JobQueue PHP API](https://help.zend.com/zendphp/current/content/zendhq/zendhq_jobqueue_php_api.htm).
