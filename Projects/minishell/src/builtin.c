/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   builtin.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/12 18:54:25 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/12 19:18:28 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

int		builtin(char **args)
{
	if (!ft_strcmp(args[0], "exit"))
		exit(1);
	if (ft_strcmp(args[0], "cd") || ft_strcmp(args[0], "echo") 
		|| ft_strcmp(args[0], "env") || ft_strcmp(args[0], "setenv") 
		|| ft_strcmp(args[0], "unsetenv"))
		return (0);
	printf("mignon\n");
	if (!ft_strcmp(args[0], "cd"))
		printf("go for cd\n");
	else if (!ft_strcmp(args[0], "echo"))
		printf("go for echo\n");
	else if (!ft_strcmp(args[0], "env"))
		printf("go for env\n");
	else if (!ft_strcmp(args[0], "setenv"))
		printf("go for setenv\n");
	else if (!ft_strcmp(args[0], "unsetenv"))
		printf("go for unsetenv\n");
	return (1);
}
