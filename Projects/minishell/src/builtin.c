/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   builtin.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/12 18:54:25 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/16 16:59:41 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

int		builtin(char **args, t_shell *shell)
{
	if (!ft_strcmp(args[0], "exit"))
		exit(0);
	if (!ft_strcmp(args[0], "cd"))
		printf("go for cd\n");
	else if (!ft_strcmp(args[0], "echo"))
		echo(args);
	else if (!ft_strcmp(args[0], "env"))
		env(shell);
	else if (!ft_strcmp(args[0], "setenv"))
		printf("go for setenv\n");
	else if (!ft_strcmp(args[0], "unsetenv"))
		printf("go for unsetenv\n");
	else
		return (0);
	return (1);
}

/*
**		To upgrade
*/

void    echo(char **args)
{
    int    i;

    i = 1;
    while (args[i])
    {
		ft_putstr(args[i]);
        ft_putchar(' ');
		i++;
    }
    ft_putchar('\n');
}

void	env(t_shell *shell)
{
	int		i;

	i = 0;
	while (shell->env[i])
	{
		ft_putstr(shell->env[i]);
		ft_putstr("\n");
		i++;
	}
}
