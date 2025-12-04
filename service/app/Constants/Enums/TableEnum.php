<?php

declare(strict_types=1);

namespace App\Constants\Enums;

enum TableEnum: string implements EnumInterface
{
    use BaseEnumTrait;

    case ACTIVITY_LOGS          = 'activity_logs';
    case FLOW_NODE_SNAPSHOTS    = 'flow_node_snapshots';
    case FLOW_NODE_TASKS        = 'flow_node_tasks';
    case FLOW_NODE_TEMPLATES    = 'flow_node_templates';
    case FLOW_NODES             = 'flow_nodes';
    case FLOW_TEMPLATE_VERSIONS = 'flow_template_versions';
    case FLOW_TEMPLATES         = 'flow_templates';
    case FLOWS                  = 'flows';
    case USER_EXTENDS           = 'user_extends';
    case USERS                  = 'users';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVITY_LOGS          => '系统操作日志',
            self::FLOW_NODE_SNAPSHOTS    => '流程节点快照',
            self::FLOW_NODE_TASKS        => '流程节点任务',
            self::FLOW_NODE_TEMPLATES    => '流程节点模板',
            self::FLOW_NODES             => '流程节点',
            self::FLOW_TEMPLATE_VERSIONS => '流程模板版本',
            self::FLOW_TEMPLATES         => '流程模板',
            self::FLOWS                  => '流程',
            self::USER_EXTENDS           => '用户扩展信息',
            self::USERS                  => '用户',
            default                      => '不存在的表名称',
        };
    }
}
