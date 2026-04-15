#!/bin/bash

##############################################################################
# Rezgo Connector Debug Script
# Run this script to diagnose Rezgo integration issues
# Usage: bash rezgo-debug.sh
##############################################################################

OUTPUT_FILE="rezgo-debug-report-$(date +%Y%m%d-%H%M%S).txt"

echo "=========================================="
echo "Rezgo Connector Debug Report"
echo "Generated: $(date)"
echo "=========================================="
echo ""

{
    echo "=========================================="
    echo "SYSTEM INFORMATION"
    echo "=========================================="
    echo "Timestamp: $(date)"
    echo "Current User: $(whoami)"
    echo "Current Directory: $(pwd)"
    echo "OS: $(uname -s)"
    echo ""
    
    # Check for Laravel installation
    if [ -f "artisan" ]; then
        echo "✓ Laravel installation found"
        echo ""
        
        echo "=========================================="
        echo "REZGO DEBUG - INVENTORY"
        echo "=========================================="
        
        # Try Docker first
        if command -v docker &> /dev/null; then
            echo "Docker detected, checking for running containers..."
            CONTAINERS=$(docker ps --format "{{.Names}}" 2>/dev/null | grep -i app)
            
            if [ -n "$CONTAINERS" ]; then
                echo "Found Docker containers: $CONTAINERS"
                echo ""
                
                for CONTAINER in $CONTAINERS; do
                    echo "Running debug command in container: $CONTAINER"
                    docker exec "$CONTAINER" php artisan rezgo:debug-inventory 2>&1
                    echo ""
                done
            else
                echo "No running Docker app containers found"
                echo ""
                echo "Running locally (non-Docker mode)..."
                php artisan rezgo:debug-inventory 2>&1
            fi
        else
            echo "Docker not available, running directly..."
            php artisan rezgo:debug-inventory 2>&1
        fi
        
        echo ""
        echo "=========================================="
        echo "ENVIRONMENT CHECK"
        echo "=========================================="
        php artisan rezgo:debug-inventory 2>&1 | head -5
        
        echo ""
        echo "=========================================="
        echo "APPLICATION LOGS (Last 50 lines)"
        echo "=========================================="
        
        if [ -f "storage/logs/laravel.log" ]; then
            tail -50 storage/logs/laravel.log
        else
            echo "No Laravel log file found at storage/logs/laravel.log"
        fi
        
        echo ""
        echo "=========================================="
        echo "PHP CONFIGURATION"
        echo "=========================================="
        php -v
        php -i | grep -E "memory_limit|max_execution_time|curl|json"
        
        echo ""
        echo "=========================================="
        echo "DATABASE CONNECTION"
        echo "=========================================="
        php artisan tinker --execute="echo 'Database connection test: ' . (\DB::connection()->getPdo() ? 'OK' : 'FAILED');" 2>&1
        
        echo ""
        echo "=========================================="
        echo "REZGO PLUGIN STATUS"
        echo "=========================================="
        if [ -d "platform/plugins/rezgo-plugin" ]; then
            echo "✓ Rezgo Plugin directory found"
            echo "Plugin location: $(pwd)/platform/plugins/rezgo-plugin"
            echo ""
            echo "Plugin files:"
            ls -la platform/plugins/rezgo-plugin/src/Http/Controllers/ 2>/dev/null | head -5
            echo ""
        else
            echo "✗ Rezgo Plugin directory NOT found"
        fi
        
        echo "=========================================="
        echo "DEBUG COMPLETE"
        echo "=========================================="
        echo "Report generated: $(date)"
        
    else
        echo "✗ Error: Not in a Laravel application directory"
        echo "Please run this script from the Laravel root directory (where 'artisan' file is located)"
        exit 1
    fi
    
} | tee "$OUTPUT_FILE"

echo ""
echo "=========================================="
echo "Report saved to: $OUTPUT_FILE"
echo "=========================================="
echo ""
echo "Next steps:"
echo "1. Review the output above"
echo "2. Send this file to support: $OUTPUT_FILE"
echo "3. Also check: storage/logs/laravel.log"
echo ""
